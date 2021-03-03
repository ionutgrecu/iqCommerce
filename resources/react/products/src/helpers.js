export const inArray = (needle, haystack) => {
    var length = haystack.length;
    for (var i = 0; i < length; i++)
        if (haystack[i] == needle) return true;

    return false;
}

/** Convert an internal url to an absolute one by prepend ASSETS_URL . If external url, it returned as it is
 */
export const urlAbsolute = (url) => {
    if (url && 'string'==typeof(url) && url.indexOf('://') == -1)
        return ASSETS_URL + url
    else return url
}
