function removeAccents(str) {
    var AccentsMap = [
        "aàảãáạăằẳẵắặâầẩẫấậ",
        "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
        "dđ", "DĐ",
        "eèẻẽéẹêềểễếệ",
        "EÈẺẼÉẸÊỀỂỄẾỆ",
        "iìỉĩíị",
        "IÌỈĨÍỊ",
        "oòỏõóọôồổỗốộơờởỡớợ",
        "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
        "uùủũúụưừửữứự",
        "UÙỦŨÚỤƯỪỬỮỨỰ",
        "yỳỷỹýỵ",
        "YỲỶỸÝỴ"
    ];
    for (var i = 0; i < AccentsMap.length; i++) {
        var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
        var char = AccentsMap[i][0];
        str = str.replace(re, char);
    }
    return str;
}

export default {
    phoneNumber: function (e) {
        let char = String.fromCharCode(e.keyCode);
        if (/^[+]?[0-9]*$/.test(char)) return true;
        else e.preventDefault();
    },

    onlyNumber: function (e) {
        let res = (e.charCode !== 8 && e.charCode === 0 || (e.charCode >= 48 && e.charCode <= 57));
        if (res) return true;
        else e.preventDefault();
    },
    floatNumber: function (e) {
        let char = String.fromCharCode(e.keyCode);
        if (/^[.]?[0-9]*$/.test(char)) return true;
        else e.preventDefault();
    },
    renderSlug: function (e) {
        const nameFormat = e.target.value.toLowerCase().replaceAll(" ", "-");
        return removeAccents(nameFormat);
    }
}