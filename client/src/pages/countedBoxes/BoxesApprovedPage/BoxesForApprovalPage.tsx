// Utility functions
import type { TableColumns } from '@/utils';
import { CreateColumns, useUnverifiedBoxesQuery, useVerifiedBoxesQuery } from '@/utils';

// Style and ant design
import s from './BoxesPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';
import { createDisplayableData } from '@/utils/Functions/createRefactorData';
import { Outlet } from 'react-router-dom';

const { Title } = Typography;
const { Content } = Layout;

export const BoxesForApprovalPage = () => {
  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'ID',
      keyName: 'collectorId',
      search: true,
      fixed: 'left',
      width: 50,
    },
    {
      titleName: 'Wolontariusz',
      keyName: 'name',
      sortType: 'string',
      search: true,
      ellipsis: true,
      fixed: 'left',
      width: 250,
    },
    {
      titleName: 'PLN',
      keyName: 'amount_PLN',
      sortType: 'number',
      width: 120,
      afterText: 'PLN',
    },
    {
      titleName: 'EUR',
      keyName: 'amount_EUR',
      afterText: '€',
      width: 90,
    },
    {
      titleName: 'GBP',
      keyName: 'amount_GBP',
      afterText: '£',
      width: 90,
    },
    {
      titleName: 'USD',
      keyName: 'amount_USD',
      afterText: '$',
      width: 90,
    },
    {
      titleName: 'Inne',
      keyName: 'comment',
      search: true,
      ellipsis: true,
      width: 200,
    },
    {
      titleName: 'Stanowisko',
      keyName: 'countingStation',
      search: true,
      width: 90,
    },
    {
      titleName: 'Godzina przeliczenia',
      keyName: 'time_counted',
      sortType: 'date',
      width: 100,
      search: true,
    },
    {
      titleName: 'Akcje',
      keyName: 'actions',
      fixed: 'right',
      width: 220,
      actions: [
        {
          title: 'Podgląd',
          link: '/liczymy/countedBoxes/show/',
          color: 'blue',
        },
        {
          title: 'Modyfikuj',
          link: '/liczymy/countedBoxes/edit/',
          color: 'blue',
        },
      ],
    },
  ];

  const { data: unverifiedData } = useUnverifiedBoxesQuery();

  const displayableData = createDisplayableData(unverifiedData);

  const { data: verifiedData } = useVerifiedBoxesQuery();

  const displayableVerifiedData = createDisplayableData(verifiedData);

  const verifiedColumns = CreateColumns(columnsOptions, displayableVerifiedData);

  // Tworzenie kolumn
  const columns = CreateColumns(columnsOptions, displayableData);

  return (
    <Layout className={'boxesList'}>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Do zatwierdzenia</Title>
          <Table
            size="small"
            bordered={true}
            columns={columns}
            pagination={false}
            dataSource={displayableData}
            rowKey="id"
            rowClassName={s.table_row}
            scroll={{ y: '40vh' }}
            className={'table'}
          />
        </Space>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Zatwierdzone</Title>
          <Table
            size="small"
            bordered={true}
            columns={verifiedColumns}
            pagination={{ pageSize: 50, position: ['bottomCenter'] }}
            dataSource={displayableVerifiedData}
            rowKey="id"
            scroll={{ y: '40vh' }}
            rowClassName={s.table_row}
          />
        </Space>

        <Outlet />
      </Content>
    </Layout>
  );
};
