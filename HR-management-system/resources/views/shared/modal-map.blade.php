<div class="modal fade" id="map-modal">
    <div class="modal-dialog modal-info modal-xl">
        <div class="modal-header">
            <h4 class="modal-title">Bản đồ vị trí</h4>
        </div>
        <div class="modal-content p-3">
            <div class="row">
                <div class="col-4 col-lg-2">
                    <div class="form-group">
                        <label for="">Giá</label>
                        <input type="text" class="form-control" id="shelf" readonly>
                    </div>
                </div>
                <div class="col-4 col-lg-2">
                    <div class="form-group">
                        <label for="">Vị trí</label>
                        <input type="text" class="form-control" id="position" readonly>
                    </div>
                </div>
                <div class="col-1">
                    <div class="form-group">
                        <label for="">&nbsp; </label>
                        <button class="btn btn-primary" style="display: none" id="save-btn">Lưu</button>
                    </div>
                </div>
            </div>
            <div class="wrapper border">
                <canvas id="map"></canvas>
            </div>
        </div>
    </div>
</div>