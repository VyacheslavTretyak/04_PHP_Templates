<div class="container">
    <div class = "row">
        <div class = "col-12">
            <h1>Add petition</h1>
            <form action="add/save" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" class="form-control" placeholder="name@example.com" id="email" name="email" required>
                 </div>
                 <div class="form-group">
                    <label for="exampleFormControlInput1">Subject</label>
                    <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required>
                 </div>
                 <div class="form-group">
                    <label for="exampleFormControlInput1">Body of Petition</label>
                    <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                </div>
                  <a class="btn btn-secondary" href="/">Back</a>
                <input class="btn btn-primary" type="submit" value="Save">
            </form>
        </div>
    </div>
</div>