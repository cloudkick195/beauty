"use strict";

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var validator = validator;
var isEmail = validator.isEmail;
var isISO8601 = validator.isISO8601;
var isIn = validator.isIn;
var escape = validator.escape;
var trim = validator.trim;
var normalizeEmail = validator.normalizeEmail;
var toDate = validator.toDate;

var reqValidator = function reqValidator(validation, data) {
  try {
    var errors = {};

    for (var key in validation) {
      var _iterator = _createForOfIteratorHelper(validation[key].type),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var type = _step.value;
          handleValidator[type](key, validation[key].name || key, errors, data);
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    }

    return errors;
  } catch (err) {
    throw new Error(err.message);
  }
};

var textError = {
  missing: function missing(name) {
    return "Please enter ".concat(name);
  },
  format: function format(name, _format) {
    return "Please enter correct format ".concat(name);
  },
  short: function short(name, min) {
    return "Please enter ".concat(name, " minimum ").concat(min, " characters");
  },
  long: function long(name, max) {
    return "Please enter ".concat(name, " less than ").concat(max, " characters");
  },
  radio: function radio(name, _radio) {
    return "Please choose ".concat(name, " is ").concat(_radio);
  }
};
var messError = {
  required: function required(name) {
    return textError.missing(name);
  },
  in: function _in(name) {
    return textError.radio(name, 'Male or female or other gender');
  },
  date: function date(name) {
    return textError.format('Date/Month/Year');
  },
  email: function email(name) {
    return textError.format(name, 'Email');
  },
  phone: function phone(name) {
    return textError.format(name);
  },
  password: function password(name) {
    return textError.short(name, 5);
  }
};
var handleValidator = {
  required: function required(key, name, errors, data) {
    return !data[key] ? errors[key] = messError.required(name) : data[key] = escape(trim(data[key]));
  },
  requiredFormat: function required(key, name, errors, data) {
    return !data[key] ? errors[key] = messError.required(name) : data[key] = trim(data[key]);
  },
  file: function file(key, name, errors, data) {
    return !data[key] ? errors[key] = messError.required(name) : data[key] = data[key];
  },
  mutiple: function mutiple(key, name, errors, data) {
    if (!data[key]) return data[key] = undefined;

    if (!data[key][0]) {
      return errors[key] = messError.required(name);
    }
  },
  in: function _in(key, name, errors, data) {
    if (!data[key]) return data[key] = undefined;
    if (!isIn(data[key], ['F', 'M', 'O'])) return errors[key] = messError.in(name);
    data[key] = escape(trim(data[key]));
  },
  date: function date(key, name, errors, data) {
    var date = data[key];
    var oldDate = data[key];
    if (!date) return data[key] = undefined;

    if (date.split("/").length == 3) {
      var dataSplit = date.split("/");
      date = dataSplit[2] + '-' + dataSplit[1] + '-' + dataSplit[0];
    } else if (data[key].split("-").length == 3) {
      var _dataSplit = date.split("-");

      date = _dataSplit[2] + '-' + _dataSplit[1] + '-' + _dataSplit[0];
    }

    if (!isISO8601(date)) {
      return errors[key] = messError.date(name);
    }

    data[key] = trim(oldDate);
  },
  email: function email(key, name, errors, data) {
    if (!data[key]) return data[key] = undefined;
    if (!isEmail(data[key])) return errors[key] = messError.email(name);
    data[key] = trim(data[key]);
  },
  password: function password(key, name, errors, data) {
    if (!data[key]) return data[key] = undefined;
    if (data[key].length < 5) return errors[key] = messError.password(name);
    data[key] = trim(data[key]);
  },
  phone: function phone(key, name, errors, data) {
    if (!data[key]) return data[key] = undefined;
    if (!validatePhone(data[key])) return errors[key] = messError.phone(name);
    data[key] = trim(data[key]);
  },
  text: function text(key, name, errors, data) {
    if (!data[key]) return data[key] = "";
    data[key] = trim(data[key]);
  }
};

var setNullVal = function setNullVal(data, valSet) {
  try {
    var _iterator2 = _createForOfIteratorHelper(valSet),
        _step2;

    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var vlS = _step2.value;
        if (!data[vlS]) data[vlS] = null;
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
  } catch (err) {
    throw new Error(err.message);
  }
};


function validatDate(date) {
    var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/;
    
    return date_regex.test(date);
}
function validateEmail(email) {
  var reGex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return reGex.test(email);
}

function validatePhone(phone) {
  var reGex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4,5})[-. ]?([0-9]{4})$/;
  return reGex.test(phone);
}

function getQueryParams(query) {
  var urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(query);
}