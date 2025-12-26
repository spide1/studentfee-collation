@extends('institute.layout')

@section('title', 'Dashboard')
@section('page_title', 'Institute Dashboard')

@section('content')



    <div class="dashboardDtlsArea">
        <div class="container-fluid">
            <div class="dashboardBreadCumBarBar">
                <div class="d-flex justify-content-between align-items-center dashboardBreadCumBarBarinner">
                    <div class="leftPart">
                        <h4 class="mb-0 font-16 page-title">Dashboard</h4>
                    </div>

                </div>
            </div>

            <div class="customrRow">

                <div class="customrColumn staticBox">
                    <div class="staticBox-inner">
                        <p class="ttl">Net Payable</p>
                        <h5>₹ {{ $netPayable ?? 0 }}</h5>
                    </div>
                </div>

                <div class="customrColumn staticBox">
                    <div class="staticBox-inner">
                        <p class="ttl">Paid Amount</p>
                        <h5>₹ {{ $paidAmount ?? 0 }}</h5>
                    </div>
                </div>

                <div class="customrColumn staticBox">
                    <div class="staticBox-inner">
                        <p class="ttl">Unpaid Amount</p>
                        <h5>₹ {{ $unpaidAmount ?? 0 }}</h5>
                    </div>
                </div>

            </div>

            <div class="dashboardDtlsAreainner">
                <div class="dashboaradPanelBody">
                    <div class="detais-top-sec">
                        <div class="details-tab-sec">
                            <div class="tab-menu">
                                <ul>
                                    <li>
                                        <a href="#" class="active" data-rel="tab-4">
                                            <i class="fa-regular fa-list"></i>
                                            Overview
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-rel="tab-5" class="">
                                            <i class="fa-regular fa-folder"></i>
                                            Free Schedule
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-rel="tab-6" class="">
                                            <i class="fa-regular fa-wallet"></i>
                                            Payments
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-rel="tab-7" class="">
                                            <i class="fa-regular fa-building-columns"></i>
                                            Bank Transfer
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-main-box pb-0">
                                <div class="tab-box" id="tab-4" style="display:block;">
                                    <div class="overview-top">
                                        <button class="schedule-btn">Flex Schedule</button>
                                    </div>
                                    <div class="students-list-bottom">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <a href="#" class="flex-edit-btn"><i
                                                                class="fa-regular fa-pencil"></i></a>
                                                    </th>
                                                    <th>Instalment</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                    <th>paid</th>
                                                    <th>Unpaid</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </td>
                                                    <td>1</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 31,000</td>
                                                    <td>₹ 31,000</td>
                                                    <td>₹ 0</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </td>
                                                    <td>2</td>
                                                    <td>₹ 0</td>
                                                    <td>₹ 32,000</td>
                                                    <td>₹ 32,000</td>
                                                    <td>₹ 0</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2">Total</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-box" id="tab-5">
                                    <div class="overview-top">
                                        <button class="schedule-btn">Flex Schedule</button>
                                    </div>
                                    <div class="students-list-bottom">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <a href="#" class="flex-edit-btn"><i
                                                                class="fa-regular fa-pencil"></i></a>
                                                    </th>
                                                    <th>Instalment</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                    <th>paid</th>
                                                    <th>Unpaid</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </td>
                                                    <td>1</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 31,000</td>
                                                    <td>₹ 31,000</td>
                                                    <td>₹ 0</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </td>
                                                    <td>2</td>
                                                    <td>₹ 0</td>
                                                    <td>₹ 32,000</td>
                                                    <td>₹ 32,000</td>
                                                    <td>₹ 0</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2">Total</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-box" id="tab-6">
                                    <div class="overview-top">
                                        <button class="schedule-btn">Flex Schedule</button>
                                    </div>
                                    <div class="students-list-bottom">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <a href="#" class="flex-edit-btn"><i
                                                                class="fa-regular fa-pencil"></i></a>
                                                    </th>
                                                    <th>Instalment</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                    <th>paid</th>
                                                    <th>Unpaid</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </td>
                                                    <td>1</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 31,000</td>
                                                    <td>₹ 31,000</td>
                                                    <td>₹ 0</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </td>
                                                    <td>2</td>
                                                    <td>₹ 0</td>
                                                    <td>₹ 32,000</td>
                                                    <td>₹ 32,000</td>
                                                    <td>₹ 0</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2">Total</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-box" id="tab-7">
                                    <div class="overview-top">
                                        <button class="schedule-btn">Flex Schedule</button>
                                    </div>
                                    <div class="students-list-bottom">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <a href="#" class="flex-edit-btn"><i
                                                                class="fa-regular fa-pencil"></i></a>
                                                    </th>
                                                    <th>Instalment</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                    <th>paid</th>
                                                    <th>Unpaid</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </td>
                                                    <td>1</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 31,000</td>
                                                    <td>₹ 31,000</td>
                                                    <td>₹ 0</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <i class="fa-regular fa-ellipsis-vertical"></i>
                                                    </td>
                                                    <td>2</td>
                                                    <td>₹ 0</td>
                                                    <td>₹ 32,000</td>
                                                    <td>₹ 32,000</td>
                                                    <td>₹ 0</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2">Total</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                    <td>₹ 1000</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    $('.tab-menu a').on('click', function (e) {
        e.preventDefault();

        // Remove active class from all tabs
        $('.tab-menu a').removeClass('active');

        // Hide all tab contents
        $('.tab-box').hide();

        // Activate clicked tab
        $(this).addClass('active');

        // Show related tab
        const tabId = $(this).data('rel');
        $('#' + tabId).fadeIn(200);
    });

});
</script>
@endpush
@push('styles')
<style>
.tab-menu a {
    cursor: pointer;
}

.tab-menu a.active {
    color: #0d6efd;
    font-weight: 600;
}
</style>
@endpush

