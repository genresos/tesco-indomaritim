<form action="{{ route('employees.daily-worker.storenew') }}" method="POST" enctype="multipart/form-data" id="formAction">
  @csrf
  <div>
    <label for="file">Unggah File .dat:</label>
    <input type="file" name="file" accept=".dat" required>
  </div>
  <div>
    <input type="submit" name="submit" value="Upload">
  </div>
</form>