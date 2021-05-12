const path = require('path');

module.exports = {
    mode: 'development',
    entry: {
        index: './front/index.js',
    },
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'dist'),
    },
    devServer: {
        contentBase: './dist',
        port: 3000,
        host: '0.0.0.0',
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx|ts|tsx)$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env','@babel/preset-react','@babel/preset-typescript']
                    }
                }
            }
        ]
    }
}