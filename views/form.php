<h1 class="pb-5">Form</h1>
<form method="POST" action="index.php">
  <div class="row row-cols-1 g-2 g-lg-1 col-lg-4 justify-content-evenly col mx-auto my-auto">
    <div class="col">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" pattern="^[A-Za-z\s'-]{1,255}$" required>
        <label for="name">Name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mb-3">
        <input class="form-control" type="date" id="dob" name="dob" placeholder="DOB" pattern="^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$" required>
        <label for="dob">Date of birth</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="john@domain.com" maxlength="320" pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$" required>
        <label for="email">Email address</label>
      </div>
    </div>
    <div class="col">
      <div class="p-2"><button type="submit" class="btn btn-primary btn-lg mt-4">Submit</button></div>
    </div>
  </div>
</form>