document.getElementById("btn_signup").onmousemove = function() {
    move(this)
};
document.getElementById("btn_signup").onmouseout = function() {
    out(this)
};
document.getElementById("btn_login").onmousemove = function() {
    move(this)
};
document.getElementById("btn_login").onmouseout = function() {
    out(this)
};
/* document.getElementById("text_forgot").onmousemove = function() {
    move(this)
};
document.getElementById("text_forgot").onmouseout = function() {
    out(this)
}; */
document.getElementById("inputuser").onmousedown = function() {
    delete_error()
};
document.getElementById("inputpass").onmousedown = function() {
    delete_error()
};
document.getElementById("inputrepass").onmousedown = function() {
    delete_error()
};

function move(x) {
    x.classList.add("move");
}

function out(x) {
    x.classList.remove("move");
}

function delete_error() {
    document.getElementById("khung_ngoai").classList.remove("noti");
    document.getElementById("label_pass").classList.remove("error");
    document.getElementById("label_repass").classList.remove("error");
    document.getElementById("label_user").classList.remove("error");
    document.getElementById("inputpass").classList.remove("error");
    document.getElementById("inputrepass").classList.remove("error");
    document.getElementById("inputuser").classList.remove("error");

};