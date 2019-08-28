export const trustHtmlFilter = ($sce) => {
    return function (val) {
        return $sce.trustAsHtml(val);
    };
};