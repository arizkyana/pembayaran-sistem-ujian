const numeral = require("numeral");

module.exports = number => numeral(number).format("0,0");
