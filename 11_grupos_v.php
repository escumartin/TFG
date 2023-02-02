<div class="row justify-content-center m-1">
    <div class="card-group col-sm-12 col-md-9 col-lg-6 col-xl-4 p-0 justify-content-center">
        <div class="card border-dark m-2">
            <div class="card-header">Generar grupos</div>
            <div class="card-body text-dark">
                <form id="formGrupos">
                    <div class="form-group">
                        <label>Nº grupos</label>
                        <div>
                            <input id="ngrupos" type="number" class="form-control" pattern="^[0-9]+" min="3" max="20" placeholder="Número" name="ngrupos">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">Generar grupos</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center m-1">
    <div id="wrapper" class="card-group col-sm-12 col-md-9 col-lg-6 col-xl-4 p-0">
        <!-- PINTAMOS LOS GRUPOS -->
    </div>
</div>