<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">&nbsp;&nbsp;Expense Name</label>
            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $mis_expense['id']; ?>">
            <input class="form-control" type="text" name="mis_expense_name" id="mis_expense_name" value="<?php echo $mis_expense['mis_exp_name']; ?>">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">&nbsp;&nbsp;Description</label>
            <input class="form-control" type="text" name="description" id="description" value="<?php echo $mis_expense['mis_exp_description'] ?>">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-3">
            <label class="form-label">&nbsp;&nbsp;Date</label>
            <input class="form-control" type="text" name="date" id="date" value="<?php echo $mis_expense['created_at'] ?>">
        </div>
    </div>
</div>