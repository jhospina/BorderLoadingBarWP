//Convierte un color hexadecimal a rgba
function osp_lbl_hex2rgb(color, opacity) {
    var R = osp_lbl_hexToR(color);
    var G = osp_lbl_hexToG(color);
    var B = osp_lbl_hexToB(color);

    if (opacity > 100) {
        opacity = opacity / 100;
    }

    return "rgba(" + R + "," + G + "," + B + "," + opacity + ")";
}


//Obtiene la colorimetria R de un color hexadecimal
function osp_lbl_hexToR(h) {
    return parseInt((osp_lbl_cutHex(h)).substring(0, 2), 16)
}
//Obtiene la colorimetria G de un color hexadecimal
function osp_lbl_hexToG(h) {
    return parseInt((osp_lbl_cutHex(h)).substring(2, 4), 16)
}

//Obtiene la colorimetria B de un color hexadecimal
function osp_lbl_hexToB(h) {
    return parseInt((osp_lbl_cutHex(h)).substring(4, 6), 16)
}
function osp_lbl_cutHex(h) {
    return (h.charAt(0) == "#") ? h.substring(1, 7) : h
}