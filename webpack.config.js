const path = require('path');

module.exports = {
    devtool: process.env.NODE_ENV === 'production' ? false : 'source-map',
    output: {
        chunkFilename: 'js/[name].js?id=[chunkhash]',
    },
    resolve: {
        alias: {
            '@': path.resolve('./resources/js'),
            '~': path.resolve('./'),
        },
    },
    plugins: [],
};
