 <div class="container-xl p-5">
                        <!-- Tab bar navigation-->
                        <mwc-tab-bar style="margin-bottom: -1px" activeIndex="0">
                            <mwc-tab label="Billing" icon="account_balance" stacked onClick='location.href="app-account-billing.html"'></mwc-tab>
                            <mwc-tab label="Notifications" icon="notifications" stacked onClick='location.href="app-account-notifications.html"'></mwc-tab>
                            <mwc-tab label="Profile" icon="person" stacked onClick='location.href="app-account-profile.html"'></mwc-tab>
                            <mwc-tab label="Security" icon="security" stacked onClick='location.href="app-account-security.html"'></mwc-tab>
                        </mwc-tab-bar>
                        <!-- Divider-->
                        <hr class="mt-0 mb-5" />
                        <!-- Billing cards row-->
                        <div class="row gx-5">
                            <div class="col-lg-4 col-sm-6 mb-5">
                                <!-- Billing card 1-->
                                <div class="card card-raised h-100">
                                    <div class="card-body">
                                        <div class="overline text-muted">Current monthly bill</div>
                                        <div class="fs-4 mb-2">$20.00</div>
                                    </div>
                                    <div class="card-footer position-relative d-flex align-items-center justify-content-between ripple-primary bg-transparent">
                                        <a class="card-link text-decoration-none stretched-link" href="#!">Switch to monthly billing</a>
                                        <i class="material-icons text-primary">arrow_forward</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 mb-5">
                                <!-- Billing card 2-->
                                <div class="card card-raised h-100">
                                    <div class="card-body">
                                        <div class="overline text-muted">Next payment due</div>
                                        <div class="fs-4 mb-2">July 15</div>
                                    </div>
                                    <div class="card-footer position-relative d-flex align-items-center justify-content-between ripple-primary bg-transparent">
                                        <a class="card-link text-decoration-none stretched-link" href="#!">View payment history</a>
                                        <i class="material-icons text-primary">arrow_forward</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 mb-5">
                                <!-- Billing card 3-->
                                <div class="card card-raised bg-primary text-white h-100">
                                    <div class="card-body">
                                        <div class="overline text-white-50">Current plan</div>
                                        <div class="fs-4 mb-2">Freelancer</div>
                                    </div>
                                    <div class="card-footer position-relative d-flex align-items-center justify-content-between ripple-light">
                                        <a class="card-link text-white text-decoration-none stretched-link" href="#!">Upgrade plan</a>
                                        <i class="material-icons text-white">upgrade</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Payment methods-->
                        <h2 class="font-monospace text-expanded text-uppercase fs-6 my-4">Payment methods</h2>
                        <div class="row gx-5">
                            <div class="col-md-6 mb-5">
                                <!-- Payment method card 1-->
                                <div class="card h-100">
                                    <div class="card-body p-4 d-flex align-items-center">
                                        <img src="assets/img/brands/cc-mastercard.svg" alt="Mastercard Icon" style="height: 48px" />
                                        <div class="ms-3">
                                            <div class="display-6">Mastercard??????????????????1234</div>
                                            <div class="small text-muted">Expires 01/25</div>
                                        </div>
                                    </div>
                                    <div class="card-actions p-3 justify-content-between">
                                        <span class="badge bg-dark ms-2">Default</span>
                                        <div class="card-action-buttons">
                                            <button class="btn btn-text-primary" type="button">Edit</button>
                                            <button class="btn btn-text-primary" type="button">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <!-- Payment method card 2-->
                                <div class="card h-100">
                                    <div class="card-body p-4 d-flex align-items-center">
                                        <img src="assets/img/brands/cc-visa.svg" alt="Visa Icon" style="height: 48px" />
                                        <div class="ms-3">
                                            <div class="display-6">Visa??????????????????1234</div>
                                            <div class="small text-muted">Expires 01/25</div>
                                        </div>
                                    </div>
                                    <div class="card-actions p-3 justify-content-end">
                                        <div class="card-action-buttons">
                                            <button class="btn btn-text-primary" type="button">Edit</button>
                                            <button class="btn btn-text-primary" type="button">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <!-- Payment method card 3-->
                                <div class="card h-100">
                                    <div class="card-body p-4 d-flex align-items-center">
                                        <img src="assets/img/brands/cc-amex.svg" alt="American Express Icon" style="height: 48px" />
                                        <div class="ms-3">
                                            <div class="display-6">American Express??????????????????1234</div>
                                            <div class="small text-muted">Expires 01/25</div>
                                        </div>
                                    </div>
                                    <div class="card-actions p-3 justify-content-end">
                                        <div class="card-action-buttons">
                                            <button class="btn btn-text-primary" type="button">Edit</button>
                                            <button class="btn btn-text-primary" type="button">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <!-- Add payment method card-->
                                <div class="card h-100 border-2 border-dashed ripple-primary">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <a class="stretched-link fst-button text-decoration-none d-inline-flex align-items-center" href="#!">
                                            <i class="material-icons icon-sm me-2">add</i>
                                            Add payment method
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Payment history-->
                        <h2 class="font-monospace text-expanded text-uppercase fs-6 my-4">Payment history</h2>
                        <div class="card card-raised overflow-hidden mb-5">
                            <div class="card-body p-0">
                                <!-- Payment history table-->
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">Transaction ID</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#39201</td>
                                                <td>06/15/2020</td>
                                                <td>$29.99</td>
                                                <td><span class="badge bg-secondary">Pending</span></td>
                                            </tr>
                                            <tr>
                                                <td>#38594</td>
                                                <td>05/15/2020</td>
                                                <td>$29.99</td>
                                                <td><span class="badge bg-success">Paid</span></td>
                                            </tr>
                                            <tr>
                                                <td>#38223</td>
                                                <td>04/15/2020</td>
                                                <td>$29.99</td>
                                                <td><span class="badge bg-success">Paid</span></td>
                                            </tr>
                                            <tr>
                                                <td>#38125</td>
                                                <td>03/15/2020</td>
                                                <td>$29.99</td>
                                                <td><span class="badge bg-success">Paid</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>