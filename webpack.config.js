const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
    entry: {
        'login': './resources/js/login.js',
        'main': './resources/js/main.js',
        'css': './resources/scss/style.scss'
    },
    output: {
        path: path.resolve('./public/js'),
        filename: '[name].js'
    },
    devtool: "source-map",
    module: {
        rules: [{
            test: /\.(sass|scss)$/,
            include: path.resolve(__dirname, 'resources/scss'),
            use: ExtractTextPlugin.extract({
                use: [{
                    loader: "css-loader",
                    options: {
                        sourceMap: true,
                        minimize: true,
                        url: false
                    }
                },
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            })
        },
        ]
    },
    plugins: [
        new ExtractTextPlugin({
            filename: '../css/style.css',
            allChunks: true,
        }),
    ]
}
