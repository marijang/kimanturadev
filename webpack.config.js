/* global process __dirname */
const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const appPath = `${path.resolve(__dirname)}`;

// Dev Server
const proxyUrl = 'kimnatura.test'; // local dev url example: dev.wordpress.com

// Theme
const themeName = 'kimnatura';
const themePath = `/wp-content/themes/${themeName}/skin`;
const themeFullPath = `${appPath}${themePath}`;
const themePublicPath = `${themePath}/public/`;
const themeEntry = `${themeFullPath}/assets/application.js`;
const themeAdminEntry = `${themeFullPath}/assets/application-admin.js`;
const themeOutput = `${themeFullPath}/public`;

// Outputs
const outputJs = 'scripts/[name].js';
const outputCss = 'styles/[name].css';
const outputFile = '[name].[ext]';
const outputImages = `images/${outputFile}`;
const outputFonts = `fonts/${outputFile}`;

const allModules = {
  rules: [
    {
      test: /\.(js|jsx)$/,
      use: 'babel-loader',
      exclude: /node_modules/,
    },
    {
      test: /\.json$/,
      exclude: /node_modules/,
      use: 'file-loader',
    },
    {
      test: /\.(png|svg|jpg|jpeg|gif|ico)$/,
      exclude: [/fonts/, /node_modules/],
      use: `file-loader?name=${outputImages}`,
    },
    {
      test: /\.(eot|otf|ttf|woff|woff2|svg)$/,
      exclude: [/images/, /node_modules/],
      use: `file-loader?name=${outputFonts}`,
    },
    {
      test: /\.scss$/,
      exclude: /node_modules/,
      use: [
        MiniCssExtractPlugin.loader,
        'css-loader', 'postcss-loader', 'sass-loader',
      ],
    },
  ],
};

const allPlugins = [
  new MiniCssExtractPlugin({
    filename: outputCss,
  }),

  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
    'window.jQuery': 'jquery'
  }),

 

  // Use BrowserSync For assets
  new BrowserSyncPlugin({
    host: 'localhost',
    port: 3000,
    proxy: proxyUrl,
    files: [
      {
        match: ['wp-content/themes/**/*.php', 'wp-content/plugins/**/*.php'],
      },
    ],
  }),

  new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),

  // // Is using vendor files, but prefered to use npm
  // new CopyWebpackPlugin([{
  //   from: `${themeFullPath}/assets/scripts/vendors`,
  //   to: `${themeOutput}/scripts/vendors`,
  // }]),

  // new CopyWebpackPlugin([{
  //   from: `${themeFullPath}/assets/scripts/widgets`,
  //   to: `${themeOutput}/scripts/widgets`,
  // }]),

  // new CopyWebpackPlugin([
  //    // Find jQuery in node_modules and copy it to public folder
  //   {
  //     from: `${appPath}/node_modules/jquery/dist/jquery.min.js`,
  //     to: `${themeOutput}/scripts/vendors`,
  //   },
  //    // If using images in css to reference directly put them in this folder. That will override the cache-busting.
  //   {
  //     from: `${themePath}/assets/static`,
  //     to: `${themeOutput}/static`,
  //   },
  // ]),

  // Copy from one target to new destination.
  new CopyWebpackPlugin([
    
        // Find jQuery in node_modules and copy it to public folder
        {
          from: `${appPath}/node_modules/jquery/dist/jquery.min.js`,
          to: `${themeOutput}/scripts/vendors`,
        },
    
        // If using images in css to reference directly put them in this folder. That will override the cache-busting.
        {
          from: `${themePath}/assets/static`,
          to: `${themeOutput}/static`,
        },
      ]),
    
      // Create manifest.json file.
      new ManifestPlugin(),
  ];

const allOptimizations = {
  runtimeChunk: false,
  splitChunks: {
    cacheGroups: {
      commons: {
        test: /[\\/]node_modules[\\/]/,
        name: 'vendors',
        chunks: 'all',
      },
    },
  },
};

// Use only for production build
if (!DEV) {
  allOptimizations.minimizer = [
    new UglifyJsPlugin({
      cache: true,
      parallel: true,
      sourceMap: true,
      uglifyOptions: {
        output: {
          comments: false,
        },
        compress: {
          warnings: false,
          drop_console: true, // eslint-disable-line camelcase
        },
      },
    }),
  ];
  allPlugins.push(new CleanWebpackPlugin([themeOutput]));
}

module.exports = [

  // Theme Skin
  {
    context: path.join(__dirname),
    entry: {
      application: [themeEntry],
      applicationAdmin: [themeAdminEntry],
    },
    output: {
      path: themeOutput,
      publicPath: themePublicPath,
      filename: outputJs,
    },
    // Don't bundle jQuery but expect it from a different source.
    externals: {
      jquery: 'jQuery',
    },

    optimization: allOptimizations,

    mode: 'production',

    module: allModules,

    plugins: allPlugins,

    devtool: DEV ? '#inline-source-map' : '',
  },
];
