const {
    MkdirPlugin,
    ParsePlugin,
    TimePlugin,
    OutputNamingPlugin,
    ThinkphpPlugin,
    TablePlugin
} = require('more-copy');

module.exports = {
    // 开启调试
    debug: true,

    // 模板路径
    template: './template',

    // 使用插件，有先后顺序
    plugins: [
        new OutputNamingPlugin({style: 'pascal'}),
        new TablePlugin({'database': 'data'}),
        new ThinkphpPlugin(),
        new TimePlugin(),
        new ParsePlugin(),
        new MkdirPlugin()
    ]
};
