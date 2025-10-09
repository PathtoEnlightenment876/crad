// =======================
// FRONT-END VIEW TOGGLING
// =======================
document.addEventListener('DOMContentLoaded', function () {
    const typeButtons = document.querySelectorAll('.defense-type-button');
    const typeSelectionView = document.getElementById('type-selection-view');
    const filterBar = document.getElementById('filter-bar');
    const scheduleContent = document.getElementById('schedule-content');
    const defenseTypeDisplay = document.getElementById('defense-type-display');
    const enterButton = document.getElementById('enterButton');
    const emptyState = document.getElementById('empty-state');

    typeButtons.forEach(button => {
        button.addEventListener('click', () => {
            currentDefenseType = button.dataset.defenseType;
            defenseTypeDisplay.value = `${currentDefenseType} SCHEDULING`;

            // Show filter bar, hide type selection
            typeSelectionView.style.display = 'none';
            filterBar.style.display = 'grid';
            emptyState.style.display = 'block';
        });
    });

    enterButton.addEventListener('click', () => {
        const dept = document.getElementById('dept-select').value;
        const cluster = document.getElementById('cluster-select').value;

        if (!dept || !cluster) {
            alert('⚠️ Please select both Department and Section before proceeding.');
            return;
        }

        // Hide empty state, show schedule content
        emptyState.style.display = 'none';
        scheduleContent.style.display = 'block';

        // Populate placeholder rows (later fetched from backend)
        const tbody = document.getElementById('schedule-table-body');
        tbody.innerHTML = `
            <tr data-group-id="1">
                <td>Group 1</td>
                <td>Adviser 1</td>
                <td>Panel A, Panel B, Panel C</td>
                <td><span class="status-badge status-pending">Pending</span></td>
                <td>--/--/----</td>
                <td>
                    <button class="btn btn-sm btn-success" disabled id="status-passed-1"
                        onclick="handleStatusUpdateConfirmation(1, 'Passed')">Passed</button>
                    <button class="btn btn-sm btn-danger" disabled id="status-failed-1"
                        onclick="handleStatusUpdateConfirmation(1, 'Failed')">Failed</button>
                </td>
            </tr>
        `;

        enableStatusChecks();
    });
});
