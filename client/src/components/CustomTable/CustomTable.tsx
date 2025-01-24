import React, { useState } from 'react';
import { Table, Checkbox, Space } from 'antd';
import type { TableProps, ColumnType } from 'antd/es/table';
import { STORAGE_VISIBLE_COLUMNS } from '@/utils';

interface CustomTableProps<T> extends TableProps<T> {
  columns: ColumnType<T>[];
  tableKey: string;
}

export const CustomTable = <T extends object>({
  columns,
  tableKey,
  ...props
}: CustomTableProps<T>) => {
  const [visibleColumns, setVisibleColumns] = useState<React.Key[]>(() => {
    const savedColumns = localStorage.getItem(`${STORAGE_VISIBLE_COLUMNS}_${tableKey}`);
    return savedColumns ? JSON.parse(savedColumns) : columns.map((col) => col.key);
  });

  const handleToggleColumn = (key: React.Key) => {
    setVisibleColumns((prev) => {
      const newVisibleColumns = prev.includes(key)
        ? prev.filter((colKey) => colKey !== key)
        : [...prev, key];
      localStorage.setItem(
        `${STORAGE_VISIBLE_COLUMNS}_${tableKey}`,
        JSON.stringify(newVisibleColumns),
      );
      return newVisibleColumns;
    });
  };

  const filteredColumns = columns.filter((col) => visibleColumns.includes(col.key!));

  return (
    <div>
      <Space wrap style={{ marginBottom: 16 }}>
        {columns.map((col) => (
          <Checkbox
            key={col.key}
            checked={visibleColumns.includes(col.key!)}
            onChange={() => handleToggleColumn(col.key!)}
          >
            {col.title as string}
          </Checkbox>
        ))}
      </Space>
      <Table {...props} columns={filteredColumns} />
    </div>
  );
};
