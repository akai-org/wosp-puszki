import { Typography, Space, Layout, Table } from 'antd';
import { useEffect } from 'react';

import type { TableColumns, DataType } from '@/utils';

import { CreateColumns } from '@components/table/CreateColumns';

import s from './BoxesApprovedPage.module.less';

const { Title } = Typography;
const { Content } = Layout;

export const BoxesForApprovalPage = () => {
  const data: DataType[] = [];
  for (let i = 0; i < 5; i++) {
    data.push(
      {
        id: '1',
        name: 'C John Brown',
        amount_EUR: 2.41,
        amount_GBP: 1.61,
        amount_USD: 7.91,
        amount_PLN: 1004,
        more: 'Puszka nr. 13',
        position: 'Stanowisko 1',
        time_counted: '2023-02-01',
      },
      {
        id: '2',
        name: 'C John Brown',
        amount_EUR: 2.41,
        amount_GBP: 1.61,
        amount_USD: 7.91,
        amount_PLN: 1004,
        more: 'Puszka nr. 13',
        position: 'Stanowisko 1',
        time_counted: '2023-02-01',
      },
    );
  }

  const columnsOptions: TableColumns[] = [
    {
      titleName: 'ID',
      keyName: 'id',
      sortType: 'string',
      search: true,
    },
    {
      titleName: 'Wolontariusz',
      keyName: 'name',
      sortType: 'string',
      search: true,
    },
    {
      titleName: 'EUR',
      keyName: 'amount_EUR',
      sortType: 'number',
    },
    {
      titleName: 'GBP',
      keyName: 'amount_GBP',
      sortType: 'number',
    },
    {
      titleName: 'USD',
      keyName: 'amount_USD',
      sortType: 'number',
    },
    {
      titleName: 'PLN',
      keyName: 'amount_PLN',
      sortType: 'number',
    },
    {
      titleName: 'Inne',
      keyName: 'more',
      search: true,
    },
    {
      titleName: 'Stanowisko',
      keyName: 'position',
      search: true,
      sortType: 'string',
    },
    {
      titleName: 'Godzina przeliczenia',
      keyName: 'time_counted',
      sortType: 'date',
    },
    {
      titleName: 'Actions',
      keyName: 'actions',
      actions: [
        {
          title: 'Approve',
          link: '/countedBoxes/boxesApproved/approve/',
          color: 'red',
        },
        {
          title: 'Show',
          link: '/countedBoxes/boxesApproved/show/',
          color: 'blue',
        },
      ],
    },
  ];

  const columns = CreateColumns(columnsOptions, data);

  useEffect(() => {
    //fetching data here
  }, []);

  return (
    <Layout>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={2}>Do zatwierdzenia</Title>
          <Table
            size="small"
            bordered={true}
            columns={columns}
            pagination={false}
            dataSource={data}
            tableLayout="fixed"
            scroll={{ y: '65vh' }}
          />
        </Space>
      </Content>
    </Layout>
  );
};
