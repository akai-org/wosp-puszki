import { Space, Button, Input } from 'antd';
import type { InputRef } from 'antd';
import { useRef, useState } from 'react';
import type { ColumnType } from 'antd/es/table';
import type { FilterConfirmProps } from 'antd/es/table/interface';
import { SearchOutlined } from '@ant-design/icons';

import type { TableColumns } from '@/utils';

import React from 'react';
import Highlighter from 'react-highlight-words';

export function CreateColumns<DataType>(
  columnsOptions: TableColumns[],
  // eslint-disable-next-line @typescript-eslint/no-unused-vars
  _data: DataType[],
) {
  const [searchText, setSearchText] = useState('');
  const [searchedColumn, setSearchedColumn] = useState('');
  const searchInput = useRef<InputRef>(null);

  const renderActions = (actions?: TableColumns['actions']) => {
    if (!actions || actions.length === 0) return;
    return {
      render: (_: unknown, record: DataType) => (
        <Space size="middle">
          {actions.map((action) => {
            return (
              // linki są do przebudowania gdy będą strony poszczególnych puszek / użytkowników
              <a
                style={{ color: action.color }}
                key={action.title}
                href={action.link ? `${action.link}${record}` : '#'}
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
      filterDropdown: ({
        setSelectedKeys,
        selectedKeys,
        confirm,
        clearFilters,
        close,
      }) => (
        <Space
          size="small"
          direction="vertical"
          style={{
            padding: '0.5rem',
            backgroundColor: '#003541',
            borderRadius: '0.5rem',
          }}
        >
          <Input
            ref={searchInput}
            placeholder={`Search ${dataIndex}`}
            value={selectedKeys[0]}
            onChange={(e) => setSelectedKeys(e.target.value ? [e.target.value] : [])}
            onPressEnter={() =>
              handleSearch(selectedKeys as string[], confirm, dataIndex)
            }
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
            <Button type="link" style={{ color: '#fff' }} onClick={close}>
              close
            </Button>
          </Space>
        </Space>
      ),
      filterIcon: (filtered: boolean) => (
        <SearchOutlined style={{ color: filtered ? '#1890ff' : undefined }} />
      ),
      onFilter: (value, record: DataType) =>
        record[dataIndex]
          .toString()
          .toLowerCase()
          .includes((value as string).toLowerCase()),
      onFilterDropdownOpenChange: (visible) => {
        if (visible) {
          searchInput.current?.select();
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

  return columnsOptions.map((column) => {
    return {
      title: column.titleName,
      dataIndex: column.keyName,
      key: column.keyName,
      ...getColumnSearchProps(column.keyName, column.search),
      ...getSorter(column.sortType, column.keyName),
      ...renderActions(column.actions),
    };
  });
}
