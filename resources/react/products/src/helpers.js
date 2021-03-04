export const inArray = (needle, haystack) => {
    var length = haystack.length;
    for (var i = 0; i < length; i++)
        if (haystack[i] == needle) return true;

    return false;
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
