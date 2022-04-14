const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const devMode = process.env.NODE_ENV !== 'production';
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
const CopyPlugin = require('copy-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const cssnano = require( 'cssnano' ); 
const OptimizeCssAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' );
const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );
module.exports = {
    entry: {
        // ---------------------theme--------------------------------
        'wp-content/themes/b-create/assets/js/app': './wp-content/themes/b-create/private/javascript/app.js',
        "wp-content/themes/b-create/assets/css/custom-style": "./wp-content/themes/b-create/private/scss/style.scss"
    },
    output: {
        path: path.resolve(__dirname),
        publicPath: "/",
        filename: '[name].js',
        chunkFilename: "./wp-content/themes/b-create/assets/javascript/[name].chunk.js"
    },
    mode: devMode ? 'development' : 'production',
    module: {
        rules: [
            {
                test: /\.s?[ac]ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    { loader: 'css-loader', options: { url: false, sourceMap: true, importLoaders: 2 } },
                    { loader: 'sass-loader', options: { sourceMap: true } }
                ],
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: "babel-loader"
            }, {
                test: /\.jsx?$/,
                exclude: /node_modules/,
                use: "babel-loader"
            },
            {
                test: /\.(png|jpg|gif)$/,
                exclude: /node_modules/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: './[path][name].[ext]',
                        emitFile: false
                    }
                }]
            }
        ]
    },
    plugins: [
        new CopyPlugin([
            // theme
            // { from: './wp-content/themes/b-create/private/assets', to: './wp-content/themes/b-create/assets' }
        ]),
        new FixStyleOnlyEntriesPlugin(),
        new MiniCssExtractPlugin({
            // online theme
            // filename: devMode ? './wp-content/themes/online-shop-child/assets/styles/[name].css' : './wp-content/themes/online-shop-child/[name].[hash].css',
            // chunkFilename: devMode ? './wp-content/themes/online-shop-child/assets/styles/[id].css' : './wp-content/themes/online-shop-child/[id].[hash].css'

            // electro theme
            filename: devMode ? '[name].css' : '[name].css',
            chunkFilename: devMode ? '[id].css' : '[id].css'
        })
    ],
    optimization: {
        minimizer: [
            new TerserPlugin(),
            new UglifyJsPlugin( {
                cache: false,
                parallel: true,
                sourceMap: false
            } )
        ],
        namedModules: true,
        namedChunks: true
    },
    devtool: devMode ? 'inline-source-map' : false,
    performance: {
        hints: false,
        maxEntrypointSize: 512000,
        maxAssetSize: 512000
    }
}
