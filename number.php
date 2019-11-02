<?php require_once 'includes/header.php' ?>
<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <form method="post" action="numberPro.php" class="form form-inline">
                <div class="form-group">
                    <label class="ml-2">From:</label>
                    <input type="number" name="txtFrom" value="0" class="form-control">
                    <label class="ml-2">To:</label>
                    <input type="number" name="txtTo" value="9" class="form-control">
                    <select name="slType" class="form-control ml-2">
                        <option value="">Select...</option>
                        <option value="1">Odd</option>
                        <option value="2">Even</option>
                    </select>
                    <select name="slOrder" class="form-control ml-2">
                        <option value="0">ACS</option>
                        <option value="1">DESC</option>
                    </select>
                    <button class="btn btn-primary ml-2">Show List</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>