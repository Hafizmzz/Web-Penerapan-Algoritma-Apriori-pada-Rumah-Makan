// route 
var rProsesLogin = server + "auth/login/proses";
var rDashboard = server + "dashboard";
// vue object 
var loginApp = new Vue({
    el : '#divLogin',
    data : {},
    methods : {
        loginAtc : function()
        {
            loginProses();
        }
    }
});

// inisialisasi 
document.querySelector("#txtUsername").focus();

function loginProses()
{
    let username = document.querySelector("#txtUsername").value;
    let password = document.querySelector("#txtPassword").value;
    let ds = {'username':username, 'password':password}
    axios.post(rProsesLogin, ds).then(function(res){
        let obj = res.data;
        if(obj.status === "NO_USER"){
            pesanUmumApp('warning', 'Gagal Masuk', 'Nama pengguna tidak ditemukan ..');
        }else if(obj.status === 'WRONG_PASSWORD'){
            pesanUmumApp('warning', 'Gagal Masuk', 'Kata sandi salah ..');
        }else{
            window.location.assign(rDashboard);
        }
    }); 
}

function pesanUmumApp(icon, title, text)
{
  Swal.fire({
    icon : icon,
    title : title,
    text : text
  });
}