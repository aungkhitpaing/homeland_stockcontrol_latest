 <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item {{ Active::check('estimate',true) }} ">
                    <a href="/estimate">Estimate</a>
                </li>
                <li class="nav-item  {{ Active::check('dailyexpense',true) }} ">
                    <a href="/dailyexpense">Daily Expense</a>
                </li>
                <li class="nav-item  {{ Active::check('supplier',true) }} ">
                    <a href="/supplier">Supplier</a>
                </li>
                <li class="nav-item">
                    <a href="/stock-control">Stock Control</a>
                </li>
            </ul>
        </div>
    </div>
</div>