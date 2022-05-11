const {
  MkdirPlugin,
  ParsePlugin,
  TimePlugin,
  OutputNamingPlugin,
  OutputDirnameNamingPlugin,
  VuePlugin,
  MySQLPlugin,
  TablePlugin,
  ThinkphpPlugin,
  NamingPlugin,
} = require('more-copy');

module.exports = {
  // 开启调试
  debug: true,

  // 模板路径
  template: './template',

  // 使用插件，有先后顺序
  plugins: [
    new TablePlugin({ database: 'data' }),
    new ThinkphpPlugin(),
    new VuePlugin(),
    new OutputDirnameNamingPlugin({ style: 'hyphen' }),
    new TimePlugin(),
    new ParsePlugin(),
    new MkdirPlugin(),
    new NamingPlugin(),
  ],
};
