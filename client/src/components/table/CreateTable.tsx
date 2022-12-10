// Aby utworzyć nową tabelę należy podać jej dane oraz opcje kolumn
//   titleName: string;
//   keyName: string;
//   sortType?: 'number' | 'string' | 'date';
//   ----- typ sortowania, jeśli nie podamy to nie będzie sortowania
//   search?: boolean;
//   ----- czy kolumna ma mieć możliwość wyszukiwania
//   actions?: actions[];
//   ----- opcje akcji, jeśli nie podamy to nie będzie akcji

import { Space, Table, Button, Input } from 'antd';
import type { InputRef } from 'antd';
import type { ColumnsType, ColumnType } from 'antd/es/table';
import type { FilterConfirmProps } from 'antd/es/table/interface';
import { SearchOutlined } from '@ant-design/icons';

import type { TableColumns, DataType } from '@/utils';

import React, { useRef, useState } from 'react';
import Highlighter from 'react-highlight-words';

interface TableProps {
  data: DataType[];
  columnsOptions: TableColumns[];
}

interface SearchState {
  searchText: string;
  searchedColumn: string;
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  searchInput: any;
  setSearchText: (value: string) => void;
  setSearchedColumn: (value: string) => void;
}

const CreateColumns = (columnsOptions: TableColumns[], searchState: SearchState) => {
  const columns: ColumnsType<DataType> = columnsOptions.map((column) => {
    return {
      title: column.titleName,
      dataIndex: column.keyName,
      key: column.keyName,
      ...getColumnSearchProps(column.keyName, searchState, column.search),
      ...getSorter(column.sortType, column.keyName),
      ...renderActions(column.actions),
    };
  });
  return columns;
};

const renderActions = (actions?: TableColumns['actions']) => {
  if (!actions) return {};
  return {
    render: (_: unknown, record: DataType) => (
      <Space size="middle">
        {actions.map((action) => {
          return (
            // linki są do przebudowania gdy będą strony poszczególnych puszek / użytkowników
            <a
              key={action.title}
              href={action.link ? `${action.link}${record.name}` : '#'}
            >
              {action.title}
            </a>
          );
        })}
      </Space>
    ),
  };
};

const getSorter = (sortType: TableColumns['sortType'], keyName: string) => {
  const collator = new Intl.Collator();
  if (!sortType) return {};
  if (sortType === 'string') {
    return {
      sorter: {
        compare: (a: DataType, b: DataType) =>
          collator.compare(
            a[keyName as keyof DataType] as string,
            b[keyName as keyof DataType] as string,
          ),
      },
    };
  } else if (sortType === 'number') {
    return {
      sorter: {
        compare: (a: DataType, b: DataType) =>
          (a[keyName as keyof DataType] as number) -
          (b[keyName as keyof DataType] as number),
      },
    };
  } else if (sortType === 'date') {
    return {
      sorter: {
        compare: (a: DataType, b: DataType) =>
          Date.parse(a[keyName as keyof DataType] as string) -
          Date.parse(b[keyName as keyof DataType] as string),
      },
    };
  }
};

const getColumnSearchProps = (
  dataIndex: string,
  {
    searchText,
    setSearchText,
    searchedColumn,
    setSearchedColumn,
    searchInput,
  }: SearchState,
  search: boolean | undefined,
): ColumnType<DataType> => {
  if (!search) return {};

  const handleSearch = (
    selectedKeys: string[],
    confirm: (param?: FilterConfirmProps) => void,
    dataIndex: string,
  ) => {
    confirm();
    setSearchText(selectedKeys[0]);
    setSearchedColumn(dataIndex);
  };

  const handleReset = (clearFilters: () => void) => {
    clearFilters();
    setSearchText('');
  };

  return {
    filterDropdown: ({ setSelectedKeys, selectedKeys, confirm, clearFilters, close }) => (
      <Space
        size="small"
        direction="vertical"
        style={{ padding: '0.5rem', backgroundColor: '#003541', borderRadius: '0.5rem' }}
      >
        <Input
          ref={searchInput}
          placeholder={`Search ${dataIndex}`}
          value={selectedKeys[0]}
          onChange={(e) => setSelectedKeys(e.target.value ? [e.target.value] : [])}
          onPressEnter={() => handleSearch(selectedKeys as string[], confirm, dataIndex)}
          style={{ marginBottom: 8, display: 'block' }}
        />
        <Space size="middle">
          <Button
            type="primary"
            onClick={() => handleSearch(selectedKeys as string[], confirm, dataIndex)}
            icon={<SearchOutlined />}
            style={{ width: 120 }}
          >
            Search
          </Button>
          <Button
            onClick={() => clearFilters && handleReset(clearFilters)}
            style={{ width: 90 }}
          >
            Reset
          </Button>
          <Button
            type="link"
            style={{ color: '#fff' }}
            onClick={() => {
              confirm({ closeDropdown: false });
              setSearchText((selectedKeys as string[])[0]);
              setSearchedColumn(dataIndex);
            }}
          >
            Filter
          </Button>
          <Button
            type="link"
            style={{ color: '#fff' }}
            onClick={() => {
              close();
            }}
          >
            close
          </Button>
        </Space>
      </Space>
    ),
    filterIcon: (filtered: boolean) => (
      <SearchOutlined style={{ color: filtered ? '#1890ff' : undefined }} />
    ),
    onFilter: (value, record) =>
      record[dataIndex as keyof DataType]
        .toString()
        .toLowerCase()
        .includes((value as string).toLowerCase()),
    onFilterDropdownOpenChange: (visible) => {
      if (visible) {
        setTimeout(() => searchInput.current?.select(), 100);
      }
    },
    render: (text) =>
      searchedColumn === dataIndex ? (
        <Highlighter
          highlightStyle={{ backgroundColor: '#ffc069', padding: 0 }}
          searchWords={[searchText]}
          autoEscape
          textToHighlight={text ? text.toString() : ''}
        />
      ) : (
        text
      ),
  };
};

export const CreateTable = ({ data, columnsOptions }: TableProps) => {
  const [searchText, setSearchText] = useState('');
  const [searchedColumn, setSearchedColumn] = useState('');
  const searchInput = useRef<InputRef>(null);

  // Tworzymy kolumny z odpowiednimi opcjami
  const columns = CreateColumns(columnsOptions, {
    searchText,
    setSearchText,
    searchedColumn,
    setSearchedColumn,
    searchInput,
  });

  return (
    <Space>
      <Table
        size="small"
        bordered={true}
        columns={columns}
        pagination={false}
        dataSource={data}
        tableLayout="fixed"
      />
    </Space>
  );
};
