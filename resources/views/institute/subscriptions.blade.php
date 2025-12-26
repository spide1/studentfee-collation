@extends('institute.layout')

@section('content')
<div class="dashboardDtlsArea">
                    <div class="container-fluid">
                        <div class="dashboardBreadCumBarBar">
                            <div class="d-flex justify-content-between align-items-center dashboardBreadCumBarBarinner">
                                <div class="leftPart">
                                    <h4 class="mb-0 font-16 page-title">subscriptions</h4>
                                </div>

                            </div>
                        </div>

                        <div class="dashboardDtlsAreainner mb-3">
                            <div class="dashboaradPanelBody">
                                <div class="students-sec">
                                    <div class="students-top">
                                        <div class="students-top-box">
                                            <label for="">Search keyword</label>
                                            <input type="text" placeholder="Search keyword..">
                                        </div>
                                        <div class="students-top-box">
                                            <label for="">Group</label>
                                            <select name="" id="" class="form-select">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        <div class="students-top-box">
                                            <label for="">Institute</label>
                                            <select name="" id="" class="form-select">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        <div class="students-top-box">
                                            <label for="">Grade</label>
                                            <select name="" id="" class="form-select">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        <div class="students-top-box">
                                            <label for="">Academic Year</label>
                                            <select name="" id="" class="form-select">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        <div class="students-top-box top-btn-sec">
                                            <button class="box-search-btn"><i
                                                    class="fa-regular fa-magnifying-glass"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dashboardDtlsAreainner">
                            <div class="dashboaradPanelBody">
                                <div class="students-list-sec">
                                    <div class="students-list-top">
                                        <div class="left-side">
                                            <label>
                                                Show <select name="example_length" aria-controls="example"
                                                    class="form-select form-select-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries
                                            </label>
                                        </div>
                                        <div class="right-side">
                                            <button><i class="fa-regular fa-download"></i></button>
                                            <button><i class="fa-solid fa-bolt"></i> Actions</button>
                                            <button>Export CV</button>
                                            <button>Export PDF</button>
                                        </div>
                                    </div>

                                    <div class="students-list-bottom">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Student Name</th>
                                                    <th>Institute Name</th>
                                                    <th>Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center"><i class="fa-regular fa-ellipsis-vertical"></i></td>
                                                    <td>
                                                        <a href="#">Arnab Sharma</a>
                                                    </td>
                                                    <td>Calcutta Institute</td>
                                                    <td>Class 10</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
