<div class="container space27">
    <p class="space27" style="text-align: center; font-size:22px">welcome to Pesapal donation text platform</p>

    <div class="row">
        <div class="col-md-12">

            <form  action="<?php echo site_url('donors') ?>" method="post">


                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">First Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="first_name"  placeholder="First Name *" required>
                        </div>
                    </div></div>


                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Last Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name *" required>
                        </div>
                    </div></div>

  

                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Phone Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" placeholder="Your Phone *" required>
                        </div>
                    </div></div>
             

                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Description</label>
                        <div class="col-md-6">
                            <input type="text" name="description" class="form-control"/>
                        </div>
                    </div></div>


                <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Amount</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="amount" placeholder="Amount" required>
                        </div>
                    </div></div>

                <div class="col-md-offset-4 col-md-6">
                    <button type="submit" class="btn btn-success"> Donate via Pesapal</button>
                </div>

            </form>
        </div>
    </div>
</div>