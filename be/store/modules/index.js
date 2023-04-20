import camelCase from "lodash/camelCase";
const modules = {};

const requireModule = require.context(".", false, /\.js$/); // Get js files inside modules folder
requireModule.keys().forEach((fileName) => {
  if (fileName === "./index.js") {
    return;
  }
  const moduleName = camelCase(fileName.replace(/(\.\/|\.js)/g, ""));

  modules[moduleName] = requireModule(fileName).default;
});
export default modules;
