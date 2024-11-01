<div class="table-diary">
    <table id="sortableTable" class="table table-striped">
        <thead>
            <tr>
                <th onclick="sortTable(0)">STT</th>
                <th onclick="sortTable(1)">Hành động</th>
                <th onclick="sortTable(2)">Loại</th>
                <th onclick="sortTable(3)">IP Address</th>
                <th onclick="sortTable(4)">Thời gian</th>
                <th onclick="sortTable(5)">Trạng thái</th>
            </tr>
        </thead>
        <tbody id="dataBody">
            @forelse($logs as $index => $log)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->log_name }}</td>
                <td>{{ $log->properties['ip_address'] ?? 'N/A' }}</td>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->causer_type ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Không có dữ liệu để hiển thị.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div id="noDataMessage" style="display: none;">
        Không có dữ liệu để hiển thị.
    </div>
</div>