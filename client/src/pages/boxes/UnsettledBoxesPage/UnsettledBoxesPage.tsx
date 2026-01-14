// Utility functions
import type { TableColumns } from '@/utils';
import { CreateColumns,  useGetAllBoxesQuery } from '@/utils';

// Style and ant design
import s from '../BoxesPage.module.less';
import { Typography, Space, Layout } from 'antd';
import { CustomTable } from '@/components/CustomTable/CustomTable';
import { createDisplayableBoxData } from '@/utils/Functions/createRefactorData';
import { Outlet } from 'react-router-dom';

const { Title } = Typography;
const { Content } = Layout;

export const UnsettledBoxesPage = () => {
  const { data } = useGetAllBoxesQuery();

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'Puszka',
      keyName: 'id',
      sortType: 'number',
      search: true,
      fixed: 'left',
      width: 80,
    },
    {
      titleName: 'Numer ID wolontariusza',
      keyName: 'volunteer_id',
      sortType: 'number',
      search: true,
      fixed: 'left',
      width: 200,
    },
    {
      titleName: 'Wolontariusz',
      keyName: 'name',
      sortType: 'string',
      search: true,
      fixed: 'left',
      width: 200,
    },
    {
      titleName: 'PLN',
      keyName: 'amount_PLN',
      sortType: 'number',
      width: 100,
      afterText: 'PLN',
    },
    {
      titleName: 'EUR',
      keyName: 'amount_EUR',
      sortType: 'number',
      afterText: '€',
      width: 100,
    },
    {
      titleName: 'GBP',
      keyName: 'amount_GBP',
      sortType: 'number',
      afterText: '£',
      width: 100,
    },
    {
      titleName: 'USD',
      keyName: 'amount_USD',
      sortType: 'number',
      afterText: '$',
      width: 100,
    },
    {
      titleName: 'Status',
      keyName: 'status',
      width: 200,
      search: true,
      status: {
        key: 'status',
        options: {
          on: { value: 'Tak', description: 'Tak' },
          off: { value: 'Nie', description: 'Nie' },
        },
      },
    },
    {
      titleName: 'Inne',
      keyName: 'id',
      beforeText: 'Puszka nr.',
      width: 175,
    },
    {
      titleName: 'Godzina wydania',
      keyName: 'give_hour',
      sortType: 'time',
      width: 200,
    },
    {
      titleName: 'Actions',
      keyName: 'actions',
      fixed: 'right',
      width: 100,
      actions: [
        // Under no circumstance should you implement any additional buttons here
        // Any new features should go into /liczymy/countedBoxes
        {
          title: 'Podgląd',
          link: '/liczymy/boxes/unsettled/show/',
          color: '#1890FF',
        },
      ],
    },
  ];

  const displayableData = createDisplayableBoxData(data, true);
  // Tworzenie kolumn
  const columns = CreateColumns(columnsOptions);

  return (
    <Layout>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Lista puszek nierozliczonych</Title>
          <CustomTable
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={displayableData}
            rowKey="id" // To należy zmienić przy okazji podłączenia API
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
            tableKey="UnsettledBoxesPage_boxesTable"
          />
        </Space>
        <Outlet />
      </Content>
    </Layout>
  );
};
