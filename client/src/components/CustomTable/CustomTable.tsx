import React, { useState } from 'react';
import { Table, Checkbox, Space } from 'antd';
import type { TableProps, ColumnType } from 'antd/es/table';

interface CustomTableProps<T> extends TableProps<T> {
  columns: ColumnType<T>[];
}

export const CustomTable = <T extends object>({
  columns,
  ...props
}: CustomTableProps<T>) => {
  const [visibleColumns, setVisibleColumns] = useState(columns.map((col) => col.key));

  const handleToggleColumn = (key: React.Key) => {
    setVisibleColumns((prev) =>
      prev.includes(key) ? prev.filter((colKey) => colKey !== key) : [...prev, key],
    );
  };

  const filteredColumns = columns.filter((col) => visibleColumns.includes(col.key));

  return (
    <div>
      <Space wrap style={{ marginBottom: 16 }}>
        {columns.map((col) => (
          <Checkbox
            key={col.key}
            checked={visibleColumns.includes(col.key)}
            onChange={() => handleToggleColumn(col.key!)}
          >
            {col.title}
          </Checkbox>
        ))}
      </Space>
      <Table {...props} columns={filteredColumns} />
    </div>
  );
};
