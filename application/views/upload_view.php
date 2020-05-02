<div class="row col-xs-12">
  <h2>Produkt-Foto Upload</h2>
</div>
<div class="row col-md-12">
    <div id="uploader">
      Ziehen Sie Ihre Dateien mit Drag & Drop hier herein:
      <br> (Durch Drücken der [ctrl]-Taste können Sie mehrfach auswählen!)
    </div>

    <!-- STATUS -->
  <div id="upstat"></div>
  <!-- FALLBACK -->
  <div id="fallback">
      <form action="menudatenupload/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="file-upload" id="file-upload" accept="image/*">
        <input type="submit" value="Upload File" name="submit">
      </form>
  </div>
</div>
