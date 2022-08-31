<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{ env('APP_NAME')}} <script>document.write(new Date().getFullYear())</script> </span>
        </div>
    </div>
</footer>
<!-- End of Footer -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Centre d'aide</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="saveTicketForm">

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Nom & Prénom (s)</label>
                            <input class="form-control" type="text" id="nom" name="nom" />
                        </div>
                        <div class="col-sm-6">
                            <label>Email</label>
                            <input class="form-control" type="email" id="email" name="email" required/>
                        </div>
                    </div>

                    <div class="form-group">
                    <label>Objet du ticket</label>

                    <input class="form-control" type="text" id="objet" name="objet" />
                                </div>



                    <label>Problème(s) rencontré(s)</label>
                    <input class="form-control" type="text" id="probleme" name="probleme" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button id="saveTicketBtn" type="button" onclick="saveTicket()" class="btn btn-primary">Soumettre</button>
            </div>
        </div>
    </div>
</div>