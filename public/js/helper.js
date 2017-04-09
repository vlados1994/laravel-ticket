window.arrayCombine = function array_combine (keys, values) { // eslint-disable-line camelcase
    var newArray = {}
    var i = 0
    // input sanitation
    // Only accept arrays or array-like objects
    // Require arrays to have a count
    if (typeof keys !== 'object') {
        return false
    }
    if (typeof values !== 'object') {
        return false
    }
    if (typeof keys.length !== 'number') {
        return false
    }
    if (typeof values.length !== 'number') {
        return false
    }
    if (!keys.length) {
        return false
    }
    // number of elements does not match
    if (keys.length !== values.length) {
        return false
    }
    for (i = 0; i < keys.length; i++) {
        newArray[keys[i]] = values[i]
    }
    return newArray
}