// Utility functions
import type { TableColumns } from '@/utils';
import {
  CreateColumns,
  getTopPermission,
  permissions,
  useAuthContext,
  useUnverifiedBoxesQuery,
  useVerifiedBoxesQuery,
} from '@/utils';

// Style and ant design
import s from './BoxesPage.module.less';
import { Typography, Space, Layout } from 'antd';
import { CustomTable } from '@/components/CustomTable/CustomTable';
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
  const { roles } = useAuthContext();
  const topRole = getTopPermission(roles);
  const isPermitted = topRole !== null && topRole <= permissions['admin'];

  // Ustawienia dla poszczególnych kolumn
  const baseColumnsOptions: TableColumns[] = [
    {
      titleName: 'ID',
      keyName: 'collectorId',
      search: true,
      fixed: 'left',
      width: 20,
    },
    {
      titleName: 'Wolontariusz',
      keyName: 'name',
      sortType: 'string',
      search: true,
      ellipsis: true,
      fixed: 'left',
      width: 80,
    },
    {
      titleName: 'PLN',
      keyName: 'amount_PLN',
      sortType: 'number',
      width: 50,
      afterText: 'PLN',
    },
    {
      titleName: 'EUR',
      keyName: 'amount_EUR',
      afterText: '€',
      width: 30,
    },
    {
      titleName: 'GBP',
      keyName: 'amount_GBP',
      afterText: '£',
      width: 30,
    },
    {
      titleName: 'USD',
      keyName: 'amount_USD',
      afterText: '$',
      width: 30,
    },
    {
      titleName: 'Inne',
      keyName: 'comment',
      search: true,
      ellipsis: true,
      width: 60,
    },
    {
      titleName: 'Stanowisko',
      keyName: 'countingStation',
      search: true,
      width: 40,
    },
    {
      titleName: 'Godz. przeliczenia',
      keyName: 'time_counted',
      sortType: 'time',
      width: 60,
      search: true,
    },
  ];

  const { data: unverifiedData, refetch: refetchUnverified } = useUnverifiedBoxesQuery();
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
          link: '/charityBoxes/unverified/',
          color: 'red',
          icon: <CloseOutlined />,
          buttonType: 'default',
          type: 'query',
          callback() {
            refetchVerified();
            refetchUnverified();
          },
        },
        {
          title: 'Podgląd',
          link: '/liczymy/countedBoxes/show/',
          color: 'blue',
          icon: <SearchOutlined />,
          buttonType: 'tooltip',
        },
      ],
    },
  ];

  const displayableData = createDisplayableData(unverifiedData);

  const { data: verifiedData, refetch: refetchVerified } = useVerifiedBoxesQuery();

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
          link: '/charityBoxes/verified/',
          color: 'green',
          icon: <CheckOutlined />,
          buttonType: 'default',
          type: 'query',
          callback() {
            refetchVerified();
            refetchUnverified();
          },
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

  const displayableVerifiedData = createDisplayableData(verifiedData);

  const verifiedColumns = CreateColumns(verifiedColumnsOptions);

  // Tworzenie kolumn
  const columns = CreateColumns(unverifiedColumnsOptions);

  return (
    <Layout className={'boxesList'}>
      <Content className={s.content}>
        {isPermitted ? (
          <Space direction="vertical" size="small" className={s.space}>
            <Title level={4}>Do zatwierdzenia</Title>
            <CustomTable
              size="small"
              bordered={true}
              columns={columns}
              pagination={false}
              dataSource={displayableData}
              rowKey="id"
              rowClassName={s.table_row}
              scroll={{ y: '70vh' }}
              className={'table'}
            />
          </Space>
        ) : null}
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Zatwierdzone</Title>
          <CustomTable
            size="small"
            bordered={true}
            columns={verifiedColumns}
            pagination={{ pageSize: 50, position: ['bottomCenter'] }}
            dataSource={displayableVerifiedData}
            rowKey="id"
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
          />
        </Space>

        <Outlet />
      </Content>
    </Layout>
  );
};
