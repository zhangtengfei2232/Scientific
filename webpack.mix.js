let mix = require('laravel-mix');
// const webpack = require('webpack');
// const HtmlWebpackPlugin = require('html-webpack-plugin');
// const ExtractTextPlugin = require('extract-text-webpack-plugin');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.webpackConfig({
    output: {
        path: path.resolve(__dirname, './public/dist'),
        publicPath: '/dist/',
        filename:   '[name].js',
        chunkFilename: "chunks/[name].js"
    },
    module: {
        rules:[
            {
                test: /\.(woff2?|ttf|eot|svg|otf)$/,
                loader: 'file-loader',
                options: {
                    name: path => {
                        if (! /node_modules|bower_components/.test(path)) {
                            return 'fonts/[name].[ext]?[hash]';
                        }

                        return 'fonts/vendor/' + path
                            .replace(/\\/g, '/')
                            .replace(
                                /((.*(node_modules|bower_components))|fonts|font|assets)\//g, ''
                            ) + '?[hash]';
                    },
                }
            }
        ]
    },
});
mix.js('resources/assets/js/app.js', 'js')
   .sass('resources/assets/sass/app.scss', 'css')
   .extract(["vue", "element-ui", "vue-router", "axios"])
   // .copy('resources/assets/css/app.css', 'public/dist/css')
   .copy('resources/assets/img', 'public/dist/img');