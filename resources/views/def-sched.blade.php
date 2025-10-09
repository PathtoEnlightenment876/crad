@extends('layouts.app')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
    /* --- DESIGN TOKENS --- */
    :root {
        --primary-blue: #1a73e8;
        --dark-blue-button: #003366;
        --light-bg: #f5f7fa;
        --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        --dark-text: #202124;
        --group-stripe: #f7f7f7;
        --status-green: #34a853;
        --status-yellow: #fbbc05;
        --status-red: #ea4335;
        --status-light-green: #e6f4ea; 
        --status-light-red: #fce8e6; 
    }

    /* --- GENERAL STYLES & FONT --- */
    body {
        background-color: var(--light-bg);
        font-family: 'Roboto', sans-serif;
        color: var(--dark-text);
    }
    
    #main-container-bs {
        max-width: 1400px; 
        margin: 0 auto;
    }

    /* --- UI 0: DEFENSE TYPE SELECTION SCREEN --- */
    #type-selection-view {
        box-shadow: var(--card-shadow);
        min-height: 500px;
    }
    .defense-type-button {
        background-color: var(--dark-blue-button);
        color: white;
        padding: 1.5rem 3rem;
        border-radius: 2.5rem;
        font-size: 1.2rem;
        font-weight: 500;
        border: none;
        box-shadow: 0 4px 10px rgba(0, 51, 102, 0.4);
        transition: all 0.2s;
        min-width: 250px;
    }
    .defense-type-button:hover {
        background-color: #00509e;
        box-shadow: 0 6px 15px rgba(0, 51, 102, 0.6);
        transform: translateY(-2px);
    }
    .type-button-container {
        gap: 2rem;
    }

    /* --- UI 1: FILTER BAR --- */
    #filter-bar {
        box-shadow: var(--card-shadow);
    }
    .selected-type-display {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--dark-blue-button);
        text-transform: uppercase;
        white-space: nowrap;
    }
    .btn-schedule-fixed, .btn-custom-merged {
        background-color: var(--primary-blue) !important;
        color: white !important;
        font-weight: 500;
    }

    /* --- UI 2: SCHEDULE VIEW STYLES --- */
    .table-container {
        box-shadow: var(--card-shadow);
    }
    .table-custom {
        border-collapse: separate; 
        border-spacing: 0;
    }
    .table-custom th, .table-custom td { 
        border: none;
        border-bottom: 1px solid #f0f4f8;
        padding: 0.8rem 0.5rem; 
        font-size: 0.85rem; 
    }
    .table-custom thead th { 
        background-color: var(--dark-blue-button);
        color: white; 
        position: sticky;
        top: 0;
        z-index: 10;
    }

    /* Merged Cell Styles */
    .merged-cell {
        vertical-align: middle !important;
        text-align: center;
        background-color: #fcfcfc; 
    }
    .cluster-value, .panel-details-table {
        background-color: #fcfcfc;
    }
    .panel-details-table {
        font-size: 0.85rem; 
        text-align: left;
        line-height: 1.6;
        border-right: 1px solid #f0f4f8; 
        border-left: 1px solid #f0f4f8;
    }
    .panel-details-table strong { 
        color: var(--dark-text); 
        font-weight: 500; 
        font-style: normal;
    }
    .panel-edit-icon {
        cursor: pointer;
        color: var(--primary-blue);
        font-size: 1.1rem;
        margin-left: 5px;
        vertical-align: middle;
        transition: color 0.2s;
    }
    .panel-edit-icon:hover {
         color: var(--dark-blue-button);
    }

    /* Row Grouping Logic */
    #schedule-table-body tr[data-set="B"],
    #schedule-table-body tr[data-set="B"] .cluster-value,
    #schedule-table-body tr[data-set="B"] .panel-details-table {
        background-color: var(--group-stripe) !important;
    }
    
    #schedule-table-body tr:not([data-group-id="A1"]):not([data-group-id="B6"]) .cluster-value,
    #schedule-table-body tr:not([data-group-id="A1"]):not([data-group-id="B6"]) .panel-details-table {
        border-top: none;
    }
    #schedule-table-body tr[data-group-id="B6"] td {
        border-top: 2px solid #a0a0a0; 
    }

    /* Schedule Cell & Status Buttons */
    .schedule-cell { padding: 0.5rem !important; text-align: center; } 
    .status-badge { display: inline-block; padding: 0.3em 0.6em; font-size: 0.75rem; border-radius: 0.375rem; font-weight: 500;}
    .status-completed { color: var(--status-green); background-color: var(--status-light-green); }
    .status-incomplete { color: var(--status-yellow); background-color: #fef7e0; }
    
    .btn-set-schedule { background-color: #e8f0fe; color: var(--primary-blue); font-size: 0.8rem; font-weight: 500; padding: 0.4rem 0.6rem; border-radius: 0.375rem; }
    .btn-set-schedule:hover { background-color: #d1e3ff; }

    .scheduled-container { cursor: pointer; background-color: #ebf5ff; padding: 0.4rem; border-radius: 0.375rem; margin: 0.5rem 0; font-size: 0.8rem;}
    .scheduled-container:hover { background-color: #d1e3ff; }
    .scheduled-tag { line-height: 1.2; text-align: center; }

    .btn-status { font-size: 0.7rem; padding: 0.2rem 0.4rem; border-radius: 0.25rem; font-weight: 700; border: none; }
    .btn-status-passed { background-color: var(--status-light-green); color: var(--status-green); }
    .btn-status-failed { background-color: var(--status-light-red); color: var(--status-red); }
    .status-recorded-passed { background-color: var(--status-green) !important; color: white !important; }
    .status-recorded-failed { background-color: var(--status-red) !important; color: white !important; }

    /* Modal Styles */
    .modal-header-custom { background-color: var(--dark-blue-button); color: white; border-bottom: none;}
    .panel-details-box-fixed { 
        border: 1px solid #e0e0e0; 
        border-radius: 0.5rem; 
        padding: 1rem; 
        display: flex;
        gap: 1.5rem;
        margin-top: 1rem;
        background-color: #f9f9f9;
    }
    #panelEditModal .form-control[readonly] { background-color: #f0f0f0; }

    /* Schedule Modal Input Layout */
    .time-date-inputs-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr); 
        gap: 1rem;
        padding: 1rem 0;
    }
    .time-date-inputs-container .input-control-group {
        grid-column: auto; 
    }

    .panel-details-box-fixed { 
        display: flex;
        justify-content: space-between;
        gap: 1.5rem;
    }
    .panel-details-box-fixed .advisor-chair-col {
        flex: 1.2; 
    }
    .panel-details-box-fixed .member-col {
        flex: 1; 
    }

    .input-group #date-actual-input {
        opacity: 0; 
        position: absolute; 
        left: 0; 
        top: 0; 
        width: 100%; 
        height: 100%; 
        cursor: pointer;
    }
    
    .modal-body-content-fixed {
        padding: 1rem;
    }
    .btn-schedule-fixed {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
        border-radius: 0;
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }

    /* Availability Table Styling */
    .table-availability th, .table-availability td {
        text-align: center;
        vertical-align: middle;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .table-availability td:first-child {
        text-align: left;
        font-weight: 700;
        background-color: #fcfcfc;
    }
    .availability-available {
        background-color: var(--status-light-green);
    }
    .availability-unavailable {
        background-color: var(--status-light-red);
        cursor: help;
    }
    
    /* Flash effect for schedule update */
    .row-flash {
        animation: flash-row 0.5s 3;
    }
    @keyframes flash-row {
        0% { background-color: #ffffcc; }
        100% { background-color: inherit; }
    }

    /* Media Queries */
    @media (min-width: 992px) {
        #filter-bar {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
        }
        .filter-group {
            flex-grow: 1;
        }
        .selected-type-display {
            flex-shrink: 0;
        }
        .btn-custom-merged {
            flex-shrink: 0;
            min-width: 120px;
        }
    }
    @media (max-width: 991.98px) {
        #filter-bar {
            grid-template-columns: 1fr 1fr;
        }
        .selected-type-display {
            grid-column: 1 / -1; 
            text-align: center; 
        }
        .btn-custom-merged { 
            grid-column: 1 / -1; 
        }
        .time-date-inputs-container {
            grid-template-columns: 1fr 1fr;
        }
        .panel-details-box-fixed {
            flex-direction: column;
        }
    }
    @media (max-width: 575.98px) {
        .time-date-inputs-container {
            grid-template-columns: 1fr 1fr;
        }
        .panel-details-box-fixed {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid" id="main-container-bs">
    
    <div id="type-selection-view" class="text-center p-5 bg-white rounded-4 d-flex flex-column align-items-center justify-content-center mb-4">
        <h1 class="app-title fw-bold text-dark-blue mb-4">DEFENSE SCHEDULING</h1>
        <h4 class="text-muted">Select the type of defense to schedule:</h4>
        <div class="type-button-container d-flex justify-content-center flex-wrap mt-5">
            <button class="defense-type-button" data-defense-type="PRE-ORAL">Pre-oral Defense</button>
            <button class="defense-type-button" data-defense-type="FINAL DEFENSE">Final Defense</button>
            <button class="defense-type-button" data-defense-type="REDEFENSE">Re-defense</button>
        </div>
    </div>
    
    <div id="filter-bar" class="bg-white p-4 rounded-3 mb-4 d-grid" style="display: none;">
        <h1 class="selected-type-display" id="defense-type-display"></h1>
        
        <div class="filter-group">
            <label for="dept-select" class="form-label small fw-bold">Department</label>
            <select id="dept-select" class="form-select">
                <option selected disabled value="">Select Department</option>
                <option value="BSIT">BSIT</option>
                <option value="CRIM">CRIM</option>
                <option value="EDUC">EDUC</option>
                <option value="BSBA">BSBA</option>
                <option value="Psychology">Psychology</option>
                <option value="BSHM">BSHM</option>
                <option value="BSTM">BSTM</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="cluster-select" class="form-label small fw-bold">Cluster</label>
            <select id="cluster-select" class="form-select">
                <option selected disabled value="">Select Cluster</option>
                <option value="4101">4101</option>
                <option value="4102">4102</option>
                <option value="4103">4103</option>
                <option value="4104">4104</option>
                <option value="4105">4105</option>
                <option value="4106">4106</option>
                <option value="4107">4107</option>
                <option value="4108">4108</option>
                <option value="4109">4109</option>
                <option value="4110">4110</option>
            </select>
        </div>
        
        <button class="btn btn-custom-merged align-self-end py-2" id="enterButton">
            <i class="bi bi-arrow-right-circle"></i> View Schedule
        </button>
    </div>

    <div id="schedule-view" style="display: none;">
        <h2 class="text-center mb-4" id="dept-header"></h2>

        <div id="schedule-content" class="table-container">
            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th style="width: 5%;">Cluster</th>
                            <th style="width: 5%;">Set</th> 
                            <th style="width: 5%;">Group</th>
                            <th style="width: 10%;">Documents</th>
                            <th style="width: 45%;">Panels & Adviser</th>
                            <th style="width: 25%;">Set Schedule</th>
                        </tr>
                    </thead>
                    <tbody id="schedule-table-body">
                        @php
                            // This will be populated by JavaScript based on selected department and cluster
                            $scheduleData = [];
                        @endphp

                        <!-- Table rows will be generated by JavaScript based on selected department and cluster -->
                        
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="empty-state" class="text-center p-5 bg-white rounded-3 shadow-sm" style="display: none;">
            <i class="bi bi-arrow-up-circle-fill" style="font-size: 2.5rem; color: var(--primary-blue);"></i>
            <h4 class="mt-3">Awaiting Selection</h4>
            <p>Please use the filters above to select the Department and Cluster to load the corresponding schedule.</p>
        </div>
    </div>
</div>

{{-- Schedule Modal --}}
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3">
            <div class="modal-header modal-header-custom rounded-top-3 position-relative">
                <h5 class="modal-title" id="modal-title-display">Schedule Defense: C7 Set A (Group 2)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                <i class="bi bi-info-circle-fill text-white position-absolute top-0 end-0 mt-3 me-5" style="font-size: 1.5rem; cursor: pointer; z-index: 1051;" data-bs-toggle="modal" data-bs-target="#infoModal" title="Show Panel Availability"></i>
            </div>
            <div class="modal-body-content-fixed">
                <form class="time-date-inputs-container">
                    
                    <div class="input-control-group">
                        <label for="start-time-input" class="form-label small fw-bold">Start Time</label>
                        <input type="time" class="form-control text-center" id="start-time-input">
                    </div>
                    
                    <div class="input-control-group">
                        <label for="end-time-input" class="form-label small fw-bold">End Time</label>
                        <input type="time" class="form-control text-center" id="end-time-input">
                    </div>

                    <div class="input-control-group">
                        <label for="set-input" class="form-label small fw-bold">Set</label>
                        <select id="set-input" class="form-select text-center">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    
                    <div class="input-control-group">
                        <label for="date-display-input" class="form-label small fw-bold">Set Date</label>
                        <div class="input-group">
                            <input type="text" class="form-control text-center" id="date-display-input" placeholder="mm/dd/yyyy" readonly>
                            <span class="input-group-text" id="calendar-icon" style="cursor: pointer;"><i class="bi bi-calendar"></i></span>
                            <input type="date" class="form-control" id="date-actual-input">
                        </div>
                    </div>
                    
                </form>
                <div class="panel-details-box-fixed">
                    <div class="advisor-chair-col">
                        <strong>Adviser:</strong> <span id="modal-adviser"></span> <br>
                        <strong>Chairperson:</strong> <span id="modal-chairperson"></span> 
                    </div>
                    <div class="member-col">
                        <strong>Member:</strong> <span id="modal-members"></span>
                    </div>
                </div>
            </div>
            <button class="btn btn-schedule-fixed text-white" id="schedule-button" data-group-target="">Set Schedule</button>
        </div>
    </div>
</div>

{{-- Panel Edit Modal --}}
<div class="modal fade" id="panelEditModal" tabindex="-1" aria-labelledby="panelEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3">
            <div class="modal-header modal-header-custom rounded-top-3">
                <h5 class="modal-title" id="panelEditModalLabel">Edit Panel Members for <span id="panel-set-display">Set A</span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small">Edit **Chairperson** and **Members** for this panel group. The Adviser is fixed.</p>
                <div class="mb-3">
                    <label for="edit-adviser-input" class="form-label small fw-bold">Adviser (Fixed)</label>
                    <input type="text" class="form-control" id="edit-adviser-input" readonly>
                </div>
                <div class="mb-3">
                    <label for="edit-chair-input" class="form-label small fw-bold">Chairperson (Select)</label>
                    <input type="text" class="form-control" id="edit-chair-input" placeholder="e.g., Dr. Elacion">
                </div>
                <div class="mb-3">
                    <label for="edit-members-input" class="form-label small fw-bold">Members (Comma separated list)</label>
                    <input type="text" class="form-control" id="edit-members-input" placeholder="e.g., Mr. Amata, Mr. Baa">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-custom-merged" id="savePanelDetailsBtn">Save Panel Details</button>
            </div>
        </div>
    </div>
</div>

{{-- Availability Info Modal --}}
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content rounded-3">
            <div class="modal-header modal-header-custom rounded-top-3">
                <h5 class="modal-title" id="infoModalLabel">Panel Availability Schedule</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <h6 class="mb-3 fw-bold" style="color: var(--dark-text);">Availability for <span id="info-set-display" class="text-primary">Cluster 7 Set A</span> (Next 5 Work Days):</h6>
                
                <div class="table-responsive">
                    <table class="table table-sm table-availability table-custom">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Panel Member</th>
                                {{-- Dates will be inserted by JS here --}}
                            </tr>
                        </thead>
                        <tbody id="availability-table-body">
                            {{-- Availability rows will be inserted by JS here --}}
                        </tbody>
                    </table>
                </div>
                <p class="mt-3 text-muted small">
                    <i class="bi bi-square-fill" style="color: var(--status-light-green);"></i> Green cells indicate full availability. 
                    <i class="bi bi-square-fill" style="color: var(--status-light-red);"></i> Red cells show scheduled conflicts (hover for details).
                </p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-custom-merged" id="backToScheduleBtn">
                    <i class="bi bi-arrow-left"></i> Back to Scheduling
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentDefenseType = '';
    const assignmentsData = @json($assignments ?? []);

    function setScheduledTime(dateString, timeString) {
        return new Date(`${dateString}T${timeString}:00`);
    }
    
    function getAvailabilityData(name, date) {
        const d = date.getDay();
        const dateStr = date.toLocaleDateString('en-US', { month: '2-digit', day: '2-digit' });
        
        if (name === 'Dr. Elacion' && d === 2) { 
            return `Conflict: Scheduled Defense (${dateStr}, 10:00-11:00)`; 
        }
        if (name === 'Mr. Constantino' && d === 3) {
            return `Conflict: Department Meeting (${dateStr}, 13:00-14:00)`;
        }

        return "Available";
    }

    function setupAvailabilityModal(cluster, set, names) {
        const tableHeadRow = document.querySelector('#infoModal thead tr');
        const tbody = document.getElementById('availability-table-body');
        const display = document.getElementById('info-set-display');
        
        tbody.innerHTML = '';
        while (tableHeadRow.children.length > 1) {
            tableHeadRow.removeChild(tableHeadRow.lastChild);
        }

        display.textContent = `Cluster ${cluster} Set ${set}`;

        const today = new Date();
        const dates = [];
        let date = new Date(today);
        let count = 0;
        while (count < 5) {
            date.setDate(date.getDate() + 1);
            if (date.getDay() !== 0 && date.getDay() !== 6) { 
                dates.push(new Date(date));
                count++;
            }
        }

        dates.forEach(d => {
            const th = document.createElement('th');
            th.textContent = d.toLocaleDateString('en-US', { weekday: 'short', month: '2-digit', day: '2-digit' });
            tableHeadRow.appendChild(th);
        });

        names.forEach(name => {
            const row = tbody.insertRow();
            row.insertCell().textContent = name;

            dates.forEach(d => {
                const cell = row.insertCell();
                const status = getAvailabilityData(name, d);
                
                if (status === "Available") {
                    cell.textContent = 'Available';
                    cell.classList.add('availability-available');
                } else {
                    cell.textContent = status.split(':')[0]; 
                    cell.classList.add('availability-unavailable');
                    cell.title = status;
                }
            });
        });
    }
    
    function queueForRedefense(groupId, currentType) {
        const dept = document.getElementById('dept-select').value;
        const cluster = document.getElementById('cluster-select').value;
        
        console.log(`Group ${groupId} failed ${currentType}. Queued for REDEFENSE.`);
        console.log(`Details: Dept ${dept}, Cluster ${cluster}`);
        
        alert(`🚨 Group ${groupId} has been recorded as FAILED for ${currentType} and has been successfully added to the REDEFENSE scheduling queue.`);
    }

    function enableStatusChecks() {
        const now = new Date();
        const statusButtons = document.querySelectorAll('.btn-status');

        statusButtons.forEach(button => {
            const targetId = button.id.split('-').pop();
            const scheduleContainer = document.querySelector(`.scheduled-container[data-group="${targetId.substring(1)}"][data-set="${targetId.charAt(0)}"]`);
            
            if (!scheduleContainer) {
                button.setAttribute('disabled', 'true');
                return;
            }

            const endTimeString = scheduleContainer.getAttribute('data-sch-end');
            const dateString = scheduleContainer.getAttribute('data-sch-date');

            if (endTimeString && dateString) {
                const isRecorded = button.classList.contains('status-recorded-passed') || button.classList.contains('status-recorded-failed');
                
                if (isRecorded) {
                    button.setAttribute('disabled', 'true');
                    return;
                }

                const scheduledDateTime = setScheduledTime(dateString, endTimeString);
                scheduledDateTime.setMinutes(scheduledDateTime.getMinutes() + 10); 

                if (now > scheduledDateTime) {
                    button.removeAttribute('disabled');
                } else {
                    button.setAttribute('disabled', 'true');
                }
            } else {
                 button.setAttribute('disabled', 'true');
            }
        });
    }
    
    window.handleStatusUpdateConfirmation = function(groupId, status) {
        const statusLower = status.toLowerCase();
        const confirmMessage = `Are you absolutely sure you want to record Group ${groupId} as "${status.toUpperCase()}"? This action cannot be reversed.`;
        const statusButton = document.getElementById(`status-${statusLower}-${groupId}`);
        
        const defenseTypeDisplay = document.getElementById('defense-type-display');
        const currentDefenseType = defenseTypeDisplay ? defenseTypeDisplay.textContent.split(' ')[0] : 'UNKNOWN';

        if (confirm(confirmMessage)) {
            if (status === 'Failed' && (currentDefenseType === 'PRE-ORAL' || currentDefenseType === 'FINAL')) {
                queueForRedefense(groupId, currentDefenseType);
            } 
            
            const passedBtn = document.getElementById(`status-passed-${groupId}`);
            const failedBtn = document.getElementById(`status-failed-${groupId}`);
            
            passedBtn.classList.remove('status-recorded-passed');
            passedBtn.textContent = 'Passed';
            
            failedBtn.classList.remove('status-recorded-failed');
            failedBtn.textContent = 'Failed';

            statusButton.textContent = status.toUpperCase();
            statusButton.classList.add(`status-recorded-${statusLower}`);
            
            passedBtn.setAttribute('disabled', 'true');
            failedBtn.setAttribute('disabled', 'true');
            
            if (status === 'Passed') {
                const documentCell = document.querySelector(`tr[data-group-id="${groupId}"] td:nth-child(4) span`); 
                if (documentCell) {
                    documentCell.textContent = 'Completed';
                    documentCell.className = 'status-badge status-completed';
                }
                alert(`✅ Status recorded: Group ${groupId} is ${status}. (Simulated Submission)`);
            } else if (status === 'Failed') {
                const documentCell = document.querySelector(`tr[data-group-id="${groupId}"] td:nth-child(4) span`); 
                if (documentCell) {
                    documentCell.textContent = 'Revisions';
                    documentCell.className = 'status-badge status-incomplete';
                }
            }
        }
    }
    
    window.updatePanelDetails = function(panelSet) {
        const panelCell = document.querySelector(`.panel-details-table[data-panel-set="${panelSet}"]`);
        
        const adviser = panelCell.getAttribute('data-adviser');
        const chair = document.getElementById('edit-chair-input').value;
        const members = document.getElementById('edit-members-input').value;
        
        if (!panelSet) { return; }

        panelCell.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>Adviser:</strong> ${adviser} <br>
                    <strong>Chairperson:</strong> ${chair} <br>
                    Members: ${members}
                </div>
                <i class="bi bi-pencil-square panel-edit-icon" 
                    data-bs-toggle="modal" 
                    data-bs-target="#panelEditModal" 
                    data-panel-set="${panelSet}">
                </i>
            </div>
        `;
        panelCell.setAttribute('data-chair', chair);
        panelCell.setAttribute('data-members', members);
        
        document.querySelectorAll(`button[data-set="${panelSet}"], div.scheduled-container[data-set="${panelSet}"]`).forEach(el => {
             el.setAttribute('data-chair', chair);
             el.setAttribute('data-members', members);
        });

        const panelModalInstance = bootstrap.Modal.getInstance(document.getElementById('panelEditModal'));
        if (panelModalInstance) { panelModalInstance.hide(); }
        alert(`✅ Panel details for Set ${panelSet} updated successfully. (Simulated Submission)`);
    }

    function simulateScheduleSuccess(targetId) {
        const startTime = document.getElementById('start-time-input').value;
        const endTime = document.getElementById('end-time-input').value;
        const dateDisplay = document.getElementById('date-display-input').value;
        const dateActual = document.getElementById('date-actual-input').value;
        const newSet = document.getElementById('set-input').value; 

        if (!startTime || !endTime || !dateActual || !newSet) {
            alert("Please select a Start Time, End Time, Date, and Set before scheduling.");
            return;
        }

        const targetCell = document.querySelector(`[data-schedule-target="${targetId}"]`);
        if (!targetCell) return;
        const parentRow = targetCell.closest('tr');
        
        const modalTitle = document.getElementById('modal-title-display').textContent;
        const match = modalTitle.match(/C(\d) Set ([A-Z]) \(Group (\d+)\)/);
        const [_, cluster, originalSet, group] = match || [null, 'X', 'Y', targetId.substring(1)];

        let passedClass = '';
        let passedText = 'Passed';
        let failedClass = '';
        let failedText = 'Failed';
        const existingPassedBtn = document.getElementById(`status-passed-${targetId}`);
        const existingFailedBtn = document.getElementById(`status-failed-${targetId}`);

        if (existingPassedBtn && existingFailedBtn) {
             passedClass = existingPassedBtn.classList.contains('status-recorded-passed') ? 'status-recorded-passed' : '';
             passedText = passedClass ? 'PASSED' : 'Passed';
             failedClass = existingFailedBtn.classList.contains('status-recorded-failed') ? 'status-recorded-failed' : '';
             failedText = failedClass ? 'FAILED' : 'Failed';
        }

        const statusButtonsHtml = `
            <div class="d-flex justify-content-center mt-2" style="gap: 5px;">
                <button class="btn btn-sm btn-status btn-status-passed ${passedClass}" id="status-passed-${targetId}" 
                        data-schedule-time="${endTime}" data-schedule-date="${dateActual}" ${passedClass || failedClass ? 'disabled' : ''} onclick="handleStatusUpdateConfirmation('${targetId}', 'Passed')">${passedText}</button>
                <button class="btn btn-sm btn-status btn-status-failed ${failedClass}" id="status-failed-${targetId}" 
                        data-schedule-time="${endTime}" data-schedule-date="${dateActual}" ${passedClass || failedClass ? 'disabled' : ''} onclick="handleStatusUpdateConfirmation('${targetId}', 'Failed')">${failedText}</button>
            </div>
        `;

        const adviser = document.getElementById('modal-adviser').textContent;
        const chair = document.getElementById('modal-chairperson').textContent;
        const members = document.getElementById('modal-members').textContent;

        const scheduledTagHtml = `
            <div class="scheduled-container" 
                data-bs-toggle="modal" data-bs-target="#scheduleModal" 
                data-group="${group}" data-cluster="${cluster}" data-set="${newSet}" 
                data-adviser="${adviser}" data-chair="${chair}" data-members="${members}"
                data-sch-date="${dateActual}" data-sch-start="${startTime}" data-sch-end="${endTime}">
                <div class="scheduled-tag mb-1">
                    <i class="bi bi-calendar-check me-1"></i> ${dateDisplay}
                </div>
                <div class="scheduled-tag" style="font-weight: 500;">
                    <i class="bi bi-clock me-1"></i> ${startTime} - ${endTime}
                </div>
            </div>
        `;
        
        targetCell.innerHTML = scheduledTagHtml + statusButtonsHtml;
        
        const setCell = parentRow.querySelector('.set-value');
        if (setCell) {
            setCell.textContent = newSet; 
            parentRow.setAttribute('data-set', newSet); 
        }
        
        document.querySelectorAll('#schedule-table-body tr').forEach(row => {
            const isSetB = row.getAttribute('data-set') === 'B';
            row.style.backgroundColor = isSetB ? 'var(--group-stripe)' : '';
        });

        alert(`✅ Schedule Updated! Group ${targetId} (New Set: ${newSet}) booked for ${dateDisplay} at ${startTime}. (Simulated Submission)`);

        if (parentRow) {
            parentRow.classList.add('row-flash');
            setTimeout(() => parentRow.classList.remove('row-flash'), 2000);
        }

        enableStatusChecks();

        const scheduleModal = document.getElementById('scheduleModal');
        const modalInstance = bootstrap.Modal.getInstance(scheduleModal);
        if (modalInstance) {
            modalInstance.hide();
        }
    }
    
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelectionView = document.getElementById('type-selection-view');
        const filterBar = document.getElementById('filter-bar');
        const enterButton = document.getElementById('enterButton');
        const scheduleView = document.getElementById('schedule-view');
        const scheduleButton = document.getElementById('schedule-button');
        const scheduleModal = document.getElementById('scheduleModal');
        const panelEditModal = document.getElementById('panelEditModal');
        const savePanelDetailsBtn = document.getElementById('savePanelDetailsBtn');
        const deptSelect = document.getElementById('dept-select');
        const clusterSelect = document.getElementById('cluster-select');
        const dateDisplayInput = document.getElementById('date-display-input');
        const dateActualInput = document.getElementById('date-actual-input');

        function updateScheduleView() {
            const dept = deptSelect.value;
            const cluster = clusterSelect.value;
            const defenseType = currentDefenseType; 

            if (dept && cluster && defenseType) {
                // Filter assignments for selected department and cluster
                const filteredAssignments = assignmentsData.filter(assignment => 
                    assignment.department === dept && assignment.section === cluster
                );
                
                if (filteredAssignments.length > 0) {
                    document.getElementById('dept-header').textContent = `${defenseType}: DEPT. OF ${dept} (Cluster ${cluster})`;
                    generateScheduleTable(filteredAssignments);
                    document.getElementById('schedule-content').style.display = 'block';
                    document.getElementById('empty-state').style.display = 'none';
                    enableStatusChecks();
                } else {
                    document.getElementById('dept-header').textContent = `No assignments found for ${dept} - Cluster ${cluster}`;
                    document.getElementById('schedule-content').style.display = 'none';
                    document.getElementById('empty-state').style.display = 'block';
                }
            } else {
                document.getElementById('dept-header').textContent = `Select Department and Cluster to view the ${defenseType} schedule.`;
                document.getElementById('schedule-content').style.display = 'none';
                document.getElementById('empty-state').style.display = 'block';
            }
        }
        
        function generateScheduleTable(assignments) {
            const tableBody = document.getElementById('schedule-table-body');
            tableBody.innerHTML = '';
            
            let groupCounter = 1;
            let setLetter = 'A';
            
            assignments.forEach(assignment => {
                const adviser = assignment.adviser ? assignment.adviser.name : 'No Adviser';
                const panelMembers = assignment.assignment_panels || [];
                
                let chair = 'No Chair';
                let members = [];
                
                panelMembers.forEach(panel => {
                    if (panel.role === 'chairperson') {
                        chair = panel.name;
                    } else {
                        members.push(panel.name);
                    }
                });
                
                const membersStr = members.join(', ') || 'No Members';
                
                // Create 5 groups per assignment
                for (let i = 1; i <= 5; i++) {
                    const row = document.createElement('tr');
                    row.setAttribute('data-group-id', setLetter + groupCounter);
                    row.setAttribute('data-set', setLetter);
                    
                    const isFirstInSet = i === 1;
                    const groupId = setLetter + groupCounter;
                    
                    row.innerHTML = `
                        ${isFirstInSet ? `<td rowspan="5" class="merged-cell cluster-value">${assignment.section}</td>` : ''}
                        <td class="set-value"></td>
                        <td>${groupCounter}</td>
                        <td><span class="status-badge status-completed">Completed</span></td>
                        ${isFirstInSet ? `
                        <td rowspan="5" class="panel-details-table" 
                            data-adviser="${adviser}" 
                            data-chair="${chair}" 
                            data-members="${membersStr}" 
                            data-panel-set="${setLetter}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Adviser:</strong> ${adviser} <br>
                                    <strong>Chairperson:</strong> ${chair} <br>
                                    Members: ${membersStr}
                                </div>
                                <i class="bi bi-pencil-square panel-edit-icon" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#panelEditModal" 
                                    data-panel-set="${setLetter}">
                                </i>
                            </div>
                        </td>` : ''}
                        <td class="schedule-cell" data-schedule-target="${groupId}">
                            <button class="btn btn-set-schedule" data-bs-toggle="modal" data-bs-target="#scheduleModal" 
                                    data-group="${groupCounter}" data-cluster="${assignment.section}" data-set="${setLetter}" 
                                    data-adviser="${adviser}" data-chair="${chair}" data-members="${membersStr}">
                                <i class="bi bi-calendar-plus"></i> Set Schedule
                            </button>
                            <div class="d-flex justify-content-center mt-2" style="gap: 5px;">
                                <button class="btn btn-sm btn-status btn-status-passed" id="status-passed-${groupId}" disabled onclick="handleStatusUpdateConfirmation('${groupId}', 'Passed')">Passed</button>
                                <button class="btn btn-sm btn-status btn-status-failed" id="status-failed-${groupId}" disabled onclick="handleStatusUpdateConfirmation('${groupId}', 'Failed')">Failed</button>
                            </div>
                        </td>
                    `;
                    
                    tableBody.appendChild(row);
                    groupCounter++;
                }
                
                setLetter = String.fromCharCode(setLetter.charCodeAt(0) + 1);
            });
        }

        document.querySelectorAll('.defense-type-button').forEach(button => {
            button.addEventListener('click', function() {
                currentDefenseType = this.getAttribute('data-defense-type');
                
                typeSelectionView.style.display = 'none';
                filterBar.style.display = 'grid';
                scheduleView.style.display = 'block';

                document.getElementById('defense-type-display').textContent = `${currentDefenseType} SCHEDULING`;
                
                deptSelect.value = '';
                clusterSelect.value = '';
                updateScheduleView();
            });
        });

        enterButton.addEventListener('click', updateScheduleView);
        
        document.getElementById('calendar-icon').addEventListener('click', () => {
             dateActualInput.focus();
        });
         dateDisplayInput.addEventListener('click', () => {
             dateActualInput.focus();
        });

        dateActualInput.addEventListener('change', function() {
            if (this.value) {
                const [year, month, day] = this.value.split('-');
                dateDisplayInput.value = `${month}/${day}/${year}`;
            } else {
                dateDisplayInput.value = '';
            }
        });
        
        setInterval(enableStatusChecks, 60000); 

        scheduleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const isEditing = button.classList.contains('scheduled-container');
            
            const cluster = button.getAttribute('data-cluster');
            const set = button.getAttribute('data-set'); 
            const group = button.getAttribute('data-group');
            
            const panelCell = document.querySelector(`.panel-details-table[data-panel-set="${set}"]`);

            const adviser = panelCell.getAttribute('data-adviser');
            const chair = panelCell.getAttribute('data-chair');
            const members = panelCell.getAttribute('data-members');

            document.getElementById('modal-title-display').textContent = `Schedule Defense: C${cluster} Set ${set} (Group ${group})`;
            document.getElementById('modal-adviser').textContent = adviser;
            document.getElementById('modal-chairperson').textContent = chair;
            document.getElementById('modal-members').textContent = members;

            const targetId = set + group;
            scheduleButton.setAttribute('data-group-target', targetId); 
            scheduleButton.textContent = isEditing ? 'Update Schedule' : 'Set Schedule';

            document.getElementById('start-time-input').value = isEditing ? button.getAttribute('data-sch-start') : ''; 
            document.getElementById('end-time-input').value = isEditing ? button.getAttribute('data-sch-end') : ''; 
            
            const schDate = isEditing ? button.getAttribute('data-sch-date') : '';
            dateActualInput.value = schDate;
            if (schDate) {
                const [year, month, day] = schDate.split('-');
                dateDisplayInput.value = `${month}/${day}/${year}`;
            } else {
                dateDisplayInput.value = '';
            }
            
            document.getElementById('set-input').value = set;
            
            let panelNames = [adviser, chair].concat(members.split(',').map(m => m.trim())).filter(name => name);
            setupAvailabilityModal(cluster, set, panelNames);
        });

        panelEditModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const panelSet = button.getAttribute('data-panel-set');
            
            const panelCell = document.querySelector(`.panel-details-table[data-panel-set="${panelSet}"]`);

            const adviser = panelCell.getAttribute('data-adviser');
            const chair = panelCell.getAttribute('data-chair');
            const members = panelCell.getAttribute('data-members');

            document.getElementById('panel-set-display').textContent = `Set ${panelSet}`;
            savePanelDetailsBtn.setAttribute('data-panel-set', panelSet); 
            
            document.getElementById('edit-adviser-input').value = adviser; 
            document.getElementById('edit-chair-input').value = chair;
            document.getElementById('edit-members-input').value = members;
        });

        savePanelDetailsBtn.addEventListener('click', function() {
            const panelSet = this.getAttribute('data-panel-set');
            updatePanelDetails(panelSet);
        });
        
        scheduleButton.addEventListener('click', function() {
            const targetId = this.getAttribute('data-group-target');
            simulateScheduleSuccess(targetId);
        });

        document.getElementById('backToScheduleBtn').addEventListener('click', function() {
            const infoModalElement = document.getElementById('infoModal');
            const scheduleModalElement = document.getElementById('scheduleModal');

            const infoModalInstance = bootstrap.Modal.getInstance(infoModalElement);
            if (infoModalInstance) { 
                infoModalInstance.hide(); 
            }
            
            setTimeout(() => { 
                const scheduleModalInstance = bootstrap.Modal.getOrCreateInstance(scheduleModalElement);
                scheduleModalInstance.show(); 
            }, 100); 
        });
        
        if (!currentDefenseType) {
             scheduleView.style.display = 'none';
        }
        
        enableStatusChecks();
    });
</script>
@endsection