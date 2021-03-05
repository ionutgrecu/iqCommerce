export const inArray = (needle, haystack) => {
    var length = haystack.length;
    for (var i = 0; i < length; i++)
        if (haystack[i] == needle) return true;

    return false;
}

/** Recursive function to convert an object having child subobjects to array and prepare labels accordingly
 */
export const objectTreeToArrList = (obj, childParameter, labelParameter, inputParameters, outputParameters, iterationCount = 0) => {
    if ('object' != typeof (obj)) throw 'obj must be an object!'

    if ('string' != typeof (childParameter)) throw 'childParameter must be a string!'

    if ('object' != typeof (inputParameters) || 'object' != typeof (outputParameters)) throw 'inputParameters and outputParameters must be arrays!'

    if (inputParameters.length != outputParameters.length)
        throw 'inputParameters must be the same size as outputParameters!'

    let arrOut = []

    for (let o of obj) {
        let objOut = {}
        for (let i in inputParameters)
            if ('undefined' != typeof (o[inputParameters[i]])) {
                objOut[outputParameters[i]] = o[inputParameters[i]]

                if (iterationCount > 0 && inputParameters[i] == labelParameter) {
                    objOut[outputParameters[i]] = ' ' + objOut[outputParameters[i]]

                    for (let j = 0; j < iterationCount; j++)
                        objOut[outputParameters[i]] = '─' + objOut[outputParameters[i]];

                    // for (let j = 0; j < iterationCount; j++)
                    objOut[outputParameters[i]] = ' ├─' + objOut[outputParameters[i]];
                }
            }

        arrOut.push(objOut)

        if ('object' == typeof (o[childParameter]))
            arrOut.push(...objectTreeToArrList(o[childParameter], childParameter, labelParameter, inputParameters, outputParameters, iterationCount + 1))
    }

    return arrOut
}

/** Convert an internal url to an absolute one by prepend ASSETS_URL . If external url, it returned as it is
 */
export const urlAbsolute = (url) => {
    if (url && 'string' == typeof (url) && url.indexOf('://') == -1)
        return ASSETS_URL + url
    else return url
}

export const errorsRoll = (error) => {
    let errors = []
    let message = ''

    if ('object' == typeof (error.response) && error.response && 'object' == typeof (error.response.data)) {
        if ('object' == typeof (error.response.data.errors) && error.response.data.errors)
            for (let i in error.response.data.errors)
                if (error.response.data.errors.hasOwnProperty(i))
                    errors.push(error.response.data.errors[i])

        message = error.response.data.message
        errors = errors
    } else message = error

    return { message: message, errors: errors }
}
