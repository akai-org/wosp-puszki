// Utility functions
import type { TableColumns } from '@/utils';
import { CreateColumns, useUnverifiedBoxesQuery, useVerifiedBoxesQuery } from '@/utils';

// Style and ant design
import s from './BoxesPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';
import { createDisplayableData } from '@/utils/Functions/createRefactorData';
import { Outlet } from 'react-router-dom';
import {
  CheckOutlined,
  CloseOutlined,
  EditOutlined,
  SearchOutlined,
} from '@ant-design/icons';

const { Title } = Typography;
const { Content } = Layout;

export const BoxesForApprovalPage = () => {
  // Ustawienia dla poszczególnych kolumn
  const baseColumnsOptions: TableColumns[] = [
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
      width: 300,
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
      width: 250,
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
  ];

  const unverifiedColumnsOptions: TableColumns[] = [
    ...baseColumnsOptions,
    {
      titleName: 'Akcje',
      keyName: 'actions',
      fixed: 'right',
      width: 100,
      actions: [
        {
          title: ' Zatwierdź',
          link: '/liczymy/countedBoxes/show/',
          color: 'green',
          icon: <CheckOutlined />,
          buttonType: 'default',
        },
        {
          title: 'Podgląd',
          link: '/liczymy/countedBoxes/show/',
          color: 'blue',
          icon: <SearchOutlined />,
          buttonType: 'tooltip',
        },
        {
          title: 'Edytuj',
          link: '/liczymy/countedBoxes/edit/',
          color: 'gray',
          icon: <EditOutlined />,
          buttonType: 'tooltip',
        },
      ],
    },
  ];

  const verifiedColumnsOptions: TableColumns[] = [
    ...baseColumnsOptions,
    {
      titleName: 'Akcje',
      keyName: 'actions',
      fixed: 'right',
      width: 100,
      actions: [
        {
          title: ' Cofnij zatwierdzenie',
          link: '/liczymy/countedBoxes/show/',
          color: 'red',
          icon: <CloseOutlined />,
          buttonType: 'default',
        },
        {
          title: 'Podgląd',
          link: '/liczymy/countedBoxes/show/',
          color: 'blue',
          icon: <SearchOutlined />,
          buttonType: 'tooltip',
        },
        {
          title: 'Edytuj',
          link: '/liczymy/countedBoxes/edit/',
          color: 'gray',
          icon: <EditOutlined />,
          buttonType: 'tooltip',
        },
      ],
    },
  ];
  const { data: unverifiedData } = useUnverifiedBoxesQuery();

  const displayableData = createDisplayableData(unverifiedData);

  const { data: verifiedData } = useVerifiedBoxesQuery();

  const displayableVerifiedData = createDisplayableData(verifiedData);

  const verifiedColumns = CreateColumns(verifiedColumnsOptions, displayableVerifiedData);

  // Tworzenie kolumn
  const columns = CreateColumns(unverifiedColumnsOptions, displayableData);

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
            rowClassName={s.table_row}
          />
        </Space>

        <Outlet />
      </Content>
    </Layout>
  );
};
