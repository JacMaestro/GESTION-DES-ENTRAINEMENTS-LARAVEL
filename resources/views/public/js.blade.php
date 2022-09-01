<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->


<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/datatables-demo.js')}}"></script>
<script src="{{ asset('assets/js/toastr/toastr.min.js')}}"></script>
<!-- <script src="{{ asset('assets/js/black-dashboard.min.js')}}"></script> -->

<script type="text/javascript">
    $('#dataTable').DataTable({
        "language": {
            "sProcessing": "Traitement en cours ...",
            "sLengthMenu": "Afficher _MENU_ lignes",
            "sZeroRecords": "Aucun résultat trouvé",
            "sEmptyTable": "Aucune donnée disponible",
            "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
            "sInfoEmpty": "Aucune ligne affichée",
            "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
            "sInfoPostFix": "",
            "sSearch": "Chercher:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Chargement...",
            "oPaginate": {
                "sFirst": "Premier",
                "sLast": "Dernier",
                "sNext": "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending": ": Trier par ordre croissant",
                "sSortDescending": ": Trier par ordre décroissant"
            }
        }
    }); 
 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function saveNotif() {
        document.getElementById('saveNotifBtn').innerHTML = "Envoi en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#saveNotifBtn").attr("disabled", true);
        var form = $("#saveNotifForm")[0];
        var formData = new FormData(form);
        $.ajax({
            method: "POST",
            url: "/admin/addNotif",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "false") {
                    $("#saveNotifBtn").attr("disabled", false);
                    $("#saveNotifBtn").html("Envoyer");
                    toastr["error"](val[1]);
                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    $("#saveNotifBtn").attr("disabled", false);
                    $("#saveNotifBtn").html("Envoyer");
                }


            }
        })
    }

    function resetNotif() {
        document.getElementById('resetNotifBtn').innerHTML = "Suppression en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#resetNotifBtn").attr("disabled", true);
        var form = $("#saveNotifForm")[0];
        var formData = new FormData(form);
        $.ajax({
            method: "POST",
            url: "/admin/resetNotif",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "false") {
                    $("#resetNotifBtn").attr("disabled", false);
                    $("#resetNotifBtn").html("Remettre les messages à zéro");
                    toastr["error"](val[1]);
                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    $("#resetNotifBtn").attr("disabled", false);
                    $("#resetNotifBtn").html("Remettre les messages à zéro");
                }


            }
        })
    }

    function validatePhone(_string, _id) {
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (filter.test(_string, _id)) {
            return true;
        } else {
            toastr["error"]("Le format du numéro de téléphone est incorrecte");

            $("#" + _id).val("");
        }
    }

    function checkPass1() {
        var pass1 = document.getElementById('password');
        var pass2 = document.getElementById('c_password');
        var message = document.getElementById('message1');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";

        if (pass1.value.length > 5) {
            message.style.color = goodColor;
            message.innerHTML = "Nombre de caractère correcte!"
        } else {
            message.style.color = badColor;
            message.innerHTML = "Le mot de passe doit être supérieur à 5 chiffres !"
            return;
        }

        if (pass1.value == pass2.value) {
            message.style.color = goodColor;
            message.innerHTML = "Correct !"
        } else {
            message.style.color = badColor;
            message.innerHTML = "Les mots de passe sont différents"
        }
    }

    function checkPass() {
        var pass1 = document.getElementById('password');
        var pass2 = document.getElementById('c_password');
        var message = document.getElementById('message');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";

        if (pass1.value.length > 5) {
            message.style.color = goodColor;
            message.innerHTML = "Nombre de caractère correcte !"
        } else {
            message.style.color = badColor;
            message.innerHTML = "Le mot de passe doit être supérieur à 5 chiffres !"
            return;
        }

        if (pass1.value == pass2.value) {
            message.style.color = goodColor;
            message.innerHTML = "Correct !"
        } else {
            message.style.color = badColor;
            message.innerHTML = "Les mots de passe sont différents"
        }
    }


    function saveUser() {

        document.getElementById('saveUser').innerHTML = "Inscription en cours veuillez patienter... <i class='fa fa-spinner fa-spin'></i>";
        $("#saveUser").attr("disabled", true);

        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var email = $("#email").val();
        var c_password = $("#c_password").val();
        var cgu_terms = $("#cgu_terms").val();

        if ($("#cgu_terms").is(':checked')) {
            var cgu_terms = 1;
        } else {
            var cgu_terms = 0;
        }
        $.ajax({
            method: "POST",
            url: "/createUser",
            data: {
                nom: nom,
                prenom: prenom,
                email: email,
                c_password: c_password,
                cgu_terms: cgu_terms
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#saveUser").attr("disabled", false);
                    $("#saveUser").html("Enregistrer");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {

                        window.location.href = "/login";
                    }, 1000);

                    $("#formCreateUser")[0].reset();

                    $("#saveUser").attr("disabled", false);
                    $("#saveUser").html("Enregistrer");
                }


            }
        })
    }

    function saveUsers() {

        document.getElementById('saveUsers').innerHTML = "Enregistrement en cours veuillez patienter... <i class='fa fa-spinner fa-spin'></i>";
        $("#saveUsers").attr("disabled", true);
 
        var form = $("#saveGamersForm")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/admin/createGames",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||"); 

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#saveUsers").attr("disabled", false);
                    $("#saveUsers").html("Enregistrer");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {

                        window.location.href = "/admin/listsUsers";
                    }, 1000);

                    $("#saveGamers")[0].reset();

                    $("#saveUsers").attr("disabled", false);
                    $("#saveUsers").html("Enregistrer");
                }


            }
        })
    }
    function saveTraining() {

        document.getElementById('store_training').innerHTML = "Enregistrement en cours ... <i class='fa fa-spinner fa-spin'></i>";
        $("#store_training").attr("disabled", true);
 
        var form = $("#createTraining")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/admin/storeTraining",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||"); 

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#store_training").attr("disabled", false);
                    $("#store_training").html("Enregistrer");

                } else if (val[0] == "true") {
                    // var result= JSON.parse(data);
                    
                    toastr["success"](val[1]);
                    setTimeout(() => {

                        location.reload()
                    }, 1000);

                    $("#createTraining")[0].reset();

                    $("#store_training").attr("disabled", false);
                    $("#store_training").html("Enregistrer");
                }


            }
        })
    }
    function saveNotes() {

        document.getElementById('store_note').innerHTML = "Enregistrement en cours ... <i class='fa fa-spinner fa-spin'></i>";
        $("#store_note").attr("disabled", true);
 
        var form = $("#playerNote")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/admin/saveNotes",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||"); 

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#store_note").attr("disabled", false);
                    $("#store_note").html("Enregistrer");

                } else if (val[0] == "true") {
                    // var result= JSON.parse(data);
                    
                    toastr["success"](val[1]);
                    setTimeout(() => {

                        location.reload()
                    }, 1000);

                    $("#playerNote")[0].reset();

                    $("#store_note").attr("disabled", false);
                    $("#store_note").html("Enregistrer");
                }


            }
        })
    }

    function getInfos(id){ 
        var e = document.getElementById("team_id");
        var team = e.value;

        // console.log(team);    

        $.ajax({
            type: "GET",
            url: "/admin/teamsInfos",
            data: {
                team:team
            },
            success: function (data) {
                var results=JSON.parse(data);
                // var results=data;
                var output='';
                output +='<option  hidden>Choisir une équipe</option>';
                $.each(results, function (index, element) { 
                    output +='<option value="'+element.id+'">'+element.date_training+'</option>';
                });
                // console.log(output)
                $('#trainings').html(output);
                
            }
        });
        
    }
    function getPnotes(id){ 
        var e = document.getElementById("team_id");
        var team = e.value;

        // console.log(team);    

        $.ajax({
            type: "GET",
            url: "/admin/pNotes",
            data: {
                team:team
            },
            success: function (data) {
                var result=JSON.parse(data);
                $('#tableaux').html(result);
                
            }
        });
        
    }
    function getPlayer(id){ 
        var e = document.getElementById("trainings");
        var training = e.value;

        // console.log(team);    

        $.ajax({
            type: "GET",
            url: "/admin/playerInfos",
            data: {
                training:training
            },
            success: function (data) {
                var results=JSON.parse(data);
                // var results=data;
                // var output='';
                // output +='<option  hidden>Choisir une équipe</option>';
                // $.each(results, function (index, element) { 
                //     output +='<option value="'+element.id+'">'+element.date_training+'</option>';
                // });
        // console.log(data);    
                
                $('#selectPlayers').html(results);
               
                
            }
        });
        
    }
    

    function createUser() {

        document.getElementById('saveUsers').innerHTML = "Enregistrement en cours veuillez patienter... <i class='fa fa-spinner fa-spin'></i>";
        $("#saveUsers").attr("disabled", true);
 
        var form = $("#saveGamersForm")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/createUser",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||"); 

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#saveUsers").attr("disabled", false);
                    $("#saveUsers").html("Enregistrer");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {

                        window.location.href = "/login";
                    }, 1000);

                    $("#saveGamers")[0].reset();

                    $("#saveUsers").attr("disabled", false);
                    $("#saveUsers").html("Enregistrer");
                }


            }
        })
    }
    

    function saveUserEnter() {

        document.getElementById('saveUserEnter').innerHTML = "Enregistrement en cours veuillez patienter... <i class='fa fa-spinner fa-spin'></i>";
        $("#saveUserEnter").attr("disabled", true);

        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var email = $("#email").val();

        $.ajax({
            method: "POST",
            url: "/admin/createUserEnter",
            data: {
                nom: nom,
                prenom: prenom,
                email: email
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#saveUserEnter").attr("disabled", false);
                    $("#saveUserEnter").html("Enregistrer");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {

                        window.location.href = "/admin/listUsers";
                    }, 1000);

                    $("#formsaveUserEnter")[0].reset();

                    $("#saveUserEnter").attr("disabled", false);
                    $("#saveUserEnter").html("Enregistrer");
                }


            }
        })
    }

    function saveUserParent() {

        document.getElementById('saveUserParent').innerHTML = "Enregistrement en cours veuillez patienter... <i class='fa fa-spinner fa-spin'></i>";
        $("#saveUserParent").attr("disabled", true);

        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var email = $("#email").val();

        $.ajax({
            method: "POST",
            url: "/enter/createUserParent",
            data: {
                nom: nom,
                prenom: prenom,
                email: email
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#saveUserParent").attr("disabled", false);
                    $("#saveUserParent").html("Enregistrer");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {

                        window.location.href = "/enter/listUsers";
                    }, 1000);

                    $("#formsaveUserParent")[0].reset();

                    $("#saveUserParent").attr("disabled", false);
                    $("#saveUserParent").html("Enregistrer");
                }


            }
        })
    }

    function resetPass() {

        document.getElementById('resetPassBtn').innerHTML = "Réinitialisation en cours veuillez patienter... <i class='fa fa-spinner fa-spin'></i>";
        $("#resetPassBtn").attr("disabled", true);

        var email = $("#email").val();
        $.ajax({
            method: "POST",
            url: "/resetPass",
            data: {
                email: email
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#resetPassBtn").attr("disabled", false);
                    $("#resetPassBtn").html("Enregistrer");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    $("#resetPassForm")[0].reset();
                    setTimeout(() => {

                        window.location.href = "/login";
                    }, 1000);

                    $("#resetPassBtn").attr("disabled", false);
                    $("#resetPassBtn").html("Enregistrer");
                }


            }
        })
    }

    function login() {

        document.getElementById('loginBtn').innerHTML = "Connnexion en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#loginBtn").attr("disabled", true);

        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            method: "POST",
            url: "/verify",
            data: {
                email: email,
                password: password
            },

            success: function(msg) {

                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {

                    toastr["error"](val[1]);

                    $("#loginBtn").attr("disabled", false);
                    $("#loginBtn").html("Se Connecter");

                } else if (val[0] == "true") {

                    toastr["success"](val[2]);

                    if (val[1] == '1') {

                        setTimeout(() => {

                            window.location.href = "/admin/home";

                        }, 1000);

                    } else if (val[1] == '2') {

                        setTimeout(() => {

                            window.location.href = "/player/home";

                        }, 1000);

                    }  



                    $("#loginForm")[0].reset();

                    $("#loginBtn").attr("disabled", false);
                    $("#loginBtn").html("Se Connecter");
                }


            }
        })
    }

    function disable(id) {

        document.getElementById('disableBtn').innerHTML = "Désactivation en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#disableBtn").attr("disabled", true);

        $.ajax({
            method: "GET",
            url: "/admin/disable",
            data: {
                id: id
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#disableBtn").attr("disabled", false);
                    $("#disableBtn").html("Désactiver");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {

                        window.location.href = "/admin/listUsers";

                    }, 1000);



                    $("#disableBtn").attr("disabled", false);
                    $("#disableBtn").html("Désactiver");
                }


            }
        })
    }

    function enable(id) {

        document.getElementById('enableBtn').innerHTML = "Activation en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#enableBtn").attr("disabled", true);

        $.ajax({
            method: "GET",
            url: "/admin/enable",
            data: {
                id: id
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#enableBtn").attr("disabled", false);
                    $("#enableBtn").html("Approuver");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {

                        window.location.href = "/admin/listUsers";

                    }, 1000);



                    $("#enableBtn").attr("disabled", false);
                    $("#enableBtn").html("Approuver");
                }


            }
        })
    }

    function reject(id) {

        document.getElementById('rejectBtn').innerHTML = "Rejet de compte en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#rejectBtn").attr("disabled", true);

        $.ajax({
            method: "GET",
            url: "/admin/reject",
            data: {
                id: id
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#rejectBtn").attr("disabled", false);
                    $("#rejectBtn").html("Rejeter");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {

                        window.location.href = "/admin/listUsers";

                    }, 1000);



                    $("#rejectBtn").attr("disabled", false);
                    $("#rejectBtn").html("Rejeter");
                }


            }
        })
    }

    function deleteNum(id) {

        document.getElementById('deleteNumBtn').innerHTML = "Suppression en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#deleteNumBtn").attr("disabled", true);

        $.ajax({
            method: "GET",
            url: "/admin/deleteNum",
            data: {
                id: id
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    toastr["error"](val[1]);

                    $("#deleteNumBtn").attr("disabled", false);
                    $("#deleteNumBtn").html("Supprimer");

                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {

                        window.location.href = "/admin/listNum";

                    }, 1000);



                    $("#deleteNumBtn").attr("disabled", false);
                    $("#deleteNumBtn").html("Supprimer");
                }


            }
        })
    }


    function saveTicket() {

        document.getElementById('saveTicketBtn').innerHTML = "Envoi en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#saveTicketBtn").attr("disabled", true);

        var form = $("#saveTicketForm")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/saveTicket",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#saveTicketBtn").attr("disabled", false);
                    $("#saveTicketBtn").html("Soumettre");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#saveTicketBtn").attr("disabled", false);
                    $("#saveTicketBtn").html("Soumettre");
                }


            }
        })
    }

    function openDialog() {
        $("#contact_img").click()
    }

    $("#contact_img").change(function() {
        $('#apercu').attr('src', "{{asset('assets/img/user.svg')}}");
        // recuperation de l'extension du fichier
        var cheminImage = $(this)[0].value;
        var extension = cheminImage.substring(cheminImage.lastIndexOf('.') + 1).toLowerCase();

        if (extension == 'gif' || extension == 'png' || extension == 'jpg' || extension == 'jpeg') {

            if (this.files && this.files[0]) {

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#apercu').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        }
    })


    function readNotif(id) {
        var id = id;
        $.ajax({
            url: "/readNotif",
            type: "POST",
            data: {
                id: id
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "true") {
                    // toastr["success"](val[1]);

                    location.reload();

                } else if (val[0] == "false") {
                    toastr["error"](val[1]);
                }
            }
        })
    }

    function updateIMG() {
        var form = $("#profile_img")[0];
        var formData = new FormData(form);
        $.ajax({
            url: "/admin/editimg",
            type: "POST",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "true") {
                    toastr["success"](val[1]);

                    location.reload();

                } else if (val[0] == "false") {
                    toastr["error"](val[1]);
                }
            }
        })
    }

    function updateIMGUser() {
        var form = $("#profile_img")[0];
        var formData = new FormData(form);
        $.ajax({
            url: "/user/editimg",
            type: "POST",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "true") {
                    toastr["success"](val[1]);

                    location.reload();

                } else if (val[0] == "false") {
                    toastr["error"](val[1]);
                }
            }
        })
    }

    function infoUsers() {

        document.getElementById('infoUsersBtn').innerHTML = "Mise à jour en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#infoUsersBtn").attr("disabled", true);

        var form = $("#infoUsers")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/admin/updateUsers",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#infoUsersBtn").attr("disabled", false);
                    $("#infoUsersBtn").html("Mettre à jour");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#infoUsersBtn").attr("disabled", false);
                    $("#infoUsersBtn").html("Mettre à jour");
                }


            }
        })
    }

    function mdp(id) {

        document.getElementById('mdpBtn').innerHTML = "Mise à jour en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#mdpBtn").attr("disabled", true);

        var form = $("#mdp")[0];
        var formData = new FormData(form);

        formData.append("id", id);

        $.ajax({
            method: "POST",
            url: "/updateMdp",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#mdpBtn").attr("disabled", false);
                    $("#mdpBtn").html("Mettre à jour");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#mdpBtn").attr("disabled", false);
                    $("#mdpBtn").html("Mettre à jour");
                }


            }
        })
    }

    function editnumberSubmit(id) {

        document.getElementById('editnumberBtn').innerHTML = "Mise à jour en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#editnumberBtn").attr("disabled", true);
        var form = $("#editnumberForm")[0];
        var formData = new FormData(form);

        formData.append("id", id);

        $.ajax({
            method: "POST",
            url: "/admin/updateNumber",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "false") {
                    $("#editnumberBtn").attr("disabled", false);
                    $("#editnumberBtn").html("Mettre à jour");
                    toastr["error"](val[1]);
                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    $("#editnumberBtn").attr("disabled", false);
                    $("#editnumberBtn").html("Mettre à jour");
                }
            }
        })
    }

    function endWith(id) {

        var id = id;

        $.ajax({
            method: "GET",
            url: "/admin/endWith",
            data: {
                id: id
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "false") {

                    toastr["error"](val[1]);
                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        })
    }

    function endWith2(id) {

        var id = id;

        $.ajax({
            method: "GET",
            url: "/enter/endWith",
            data: {
                id: id
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "false") {

                    toastr["error"](val[1]);
                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        })
    }

    function rejectWith(id) {
        var montant = document.getElementById("montant").value;

        var id = id;

        $.ajax({
            method: "GET",
            url: "/admin/rejectWith",
            data: {
                id: id,
                montant: montant
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "false") {

                    toastr["error"](val[1]);
                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        })
    }

    function rejectWith2(id) {
        var montant = document.getElementById("montant").value;

        var id = id;

        $.ajax({
            method: "GET",
            url: "/enter/rejectWith",
            data: {
                id: id,
                montant: montant
            },

            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");
                if (val[0] == "false") {

                    toastr["error"](val[1]);
                } else if (val[0] == "true") {
                    toastr["success"](val[1]);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        })
    }

    function cashWithdraw2() {

        document.getElementById('cashWithdrawBtn2').innerHTML = "Retrait en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#cashWithdrawBtn2").attr("disabled", true);

        var form = $("#cashWithdrawForm2")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/user/addWith2",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#cashWithdrawBtn2").attr("disabled", false);
                    $("#cashWithdrawBtn2").html("Demander le retrait");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#cashWithdrawBtn2").attr("disabled", false);
                    $("#cashWithdrawBtn2").html("Demander le retrait");
                }


            }
        })
    }


    function editBalance(id) {

        document.getElementById('editBalanceBtn').innerHTML = "Veuillez patientez... <i class='fa fa-spinner fa-spin'></i>";
        $("#editBalanceBtn").attr("disabled", true);

        var form = $("#editBalanceForm")[0];
        var formData = new FormData(form);

        formData.append("id", id);

        $.ajax({
            method: "POST",
            url: "/admin/editBalance",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#editBalanceBtn").attr("disabled", false);
                    $("#editBalanceBtn").html("Soumettre");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        window.location.href = "/admin/withSolde";

                    }, 1000);



                    $("#editBalanceBtn").attr("disabled", false);
                    $("#editBalanceBtn").html("Soumettre");
                }


            }
        })
    }

    function addBalance() {

        document.getElementById('addBalanceBtn').innerHTML = "Veuillez patientez... <i class='fa fa-spinner fa-spin'></i>";
        $("#addBalanceBtn").attr("disabled", true);

        var form = $("#addBalanceForm")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/user/addBalance",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#addBalanceBtn").attr("disabled", false);
                    $("#addBalanceBtn").html("Créditer le solde");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#addBalanceBtn").attr("disabled", false);
                    $("#addBalanceBtn").html("Créditer le solde");
                }


            }
        })
    }
 

    function addBalance2() {

        document.getElementById('addBalanceBtn').innerHTML = "Veuillez patientez... <i class='fa fa-spinner fa-spin'></i>";
        $("#addBalanceBtn").attr("disabled", true);

        var form = $("#addBalanceForm")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/enter/addBalance2",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#addBalanceBtn").attr("disabled", false);
                    $("#addBalanceBtn").html("Créditer le solde");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#addBalanceBtn").attr("disabled", false);
                    $("#addBalanceBtn").html("Créditer le solde");
                }


            }
        })
    }

    function cashWithdraw() {

        document.getElementById('cashWithdrawBtn').innerHTML = "Retrait en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#cashWithdrawBtn").attr("disabled", true);

        var form = $("#cashWithdrawForm")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/user/withdraw/create",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#cashWithdrawBtn").attr("disabled", false);
                    $("#cashWithdrawBtn").html("Demander le retrait");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        
                        window.location.href = "/user/home";

                    }, 1000);



                    $("#cashWithdrawBtn").attr("disabled", false);
                    $("#cashWithdrawBtn").html("Demander le retrait");
                }


            }
        })
    }

    function cashWithdraw2() {

        document.getElementById('cashWithdrawBtn').innerHTML = "Retrait en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#cashWithdrawBtn").attr("disabled", true);

        var form = $("#cashWithdrawForm")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/enter/addWith",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#cashWithdrawBtn").attr("disabled", false);
                    $("#cashWithdrawBtn").html("Demander le retrait");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#cashWithdrawBtn").attr("disabled", false);
                    $("#cashWithdrawBtn").html("Demander le retrait");
                }


            }
        })
    }

    function numberSubmit() {

        document.getElementById('numberBtn').innerHTML = "Enregistrement en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#numberBtn").attr("disabled", true);

        var form = $("#numberForm")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/admin/saveNumber",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#numberBtn").attr("disabled", false);
                    $("#numberBtn").html("Soumettre");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#numberBtn").attr("disabled", false);
                    $("#numberBtn").html("Soumettre");
                }


            }
        })
    }

    function infoUsersUser() {

        document.getElementById('infoUsersBtn').innerHTML = "Mise à jour en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#infoUsersBtn").attr("disabled", true);

        var form = $("#infoUsers")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/user/updateUsers",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#infoUsersBtn").attr("disabled", false);
                    $("#infoUsersBtn").html("Mettre à jour");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);

                    setTimeout(() => {
                        location.reload();

                    }, 1000);



                    $("#infoUsersBtn").attr("disabled", false);
                    $("#infoUsersBtn").html("Mettre à jour");
                }


            }
        })
    }

    function keysAPI() {

        document.getElementById('keyBtn').innerHTML = "Sauvegarde en cours... <i class='fa fa-spinner fa-spin'></i>";
        $("#keyBtn").attr("disabled", true);

        var form = $("#KeyForms")[0];
        var formData = new FormData(form);

        $.ajax({
            method: "POST",
            url: "/user/addCredential",
            enctype: 'multipart/form-data',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function(msg) {
                console.log(msg);
                var val = msg.split("||");

                if (val[0] == "false") {
                    $("#keyBtn").attr("disabled", false);
                    $("#keyBtn").html("Soumettre");
                    toastr["error"](val[1]);


                } else if (val[0] == "true") {
                    toastr["success"](val[1]);


                    setTimeout(() => {

                        window.location.href = "/user/home";

                    }, 1000);



                    $("#keyBtn").attr("disabled", false);
                    $("#keyBtn").html("Soumettre");
                }


            }
        })
    }
 
</script>