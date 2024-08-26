<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo $user['name'] ?>">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $user['id'] ?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="mail" class="form-control" id="mail" name="mail" placeholder="Enter Email" value="<?php echo $user['email'] ?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="Mobile">Mobile Number</label>
            <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="<?php echo $user['mobile'] ?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
            <input type="hidden" class="form-control" id="old_password" name="old_password" value="<?php echo $user['password'] ?>">
            <input type="hidden" class="form-control" id="spassword" name="spassword" value="<?php echo $user['show_ps'] ?>">
        </div>
    </div>
</div>