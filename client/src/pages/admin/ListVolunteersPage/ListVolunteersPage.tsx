// Utility functions
import type { TableColumns } from '@/utils';
import { CreateColumns, useGetVolunteersQuery } from '@/utils';

// Style and ant design
import s from '../AdminPage.module.less';
import { Typography, Space, Layout, Table } from 'antd';
import { createDisplayableVolunteersData } from '@/utils/Functions/createRefactorData';

const { Title } = Typography;
const { Content } = Layout;

export const ListVolunteersPage = () => {
  const { data } = useGetVolunteersQuery();

  // Ustawienia dla poszczególnych kolumn
  const columnsOptions: TableColumns[] = [
    {
      titleName: 'ID',
      keyName: 'id',
      sortType: 'number',
      search: true,
      width: 150,
    },
    {
      titleName: 'Imię',
      keyName: 'name',
      sortType: 'string',
      search: true,
      width: 150,
    },
    {
      titleName: 'Nazwisko',
      keyName: 'sur_name',
      sortType: 'string',
      search: true,
      width: 150,
    },
    {
      titleName: 'Nr. telefonu',
      keyName: 'phone_number',
      search: true,
      width: 150,
    },
    {
      titleName: 'Kwota zebrana ( tylko PLN )',
      keyName: 'amount_PLN',
      sortType: 'number',
      width: 250,
      afterText: 'PLN',
    },
    {
      titleName: 'Status',
      keyName: 'status',
      width: 200,
      search: true,
      status: {
        key: 'status',
        options: {
          on: { value: 'Rozliczona', description: 'Rozliczona' },
          off: { value: 'Nierozliczona', description: 'Nie Rozliczona' },
        },
      },
    },
  ];

  const displayableData = createDisplayableVolunteersData(data);
  // Tworzenie kolumn
  const columns = CreateColumns(columnsOptions, displayableData);

  return (
    <Layout>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={4}>Lista wolontariuszy</Title>
          <Table
            size="middle"
            columns={columns}
            pagination={false}
            dataSource={displayableData}
            rowKey="volunteer_id" // To należy zmienić przy okazji podłączenia API
            scroll={{ y: '70vh' }}
            rowClassName={s.table_row}
          />
        </Space>
      </Content>
    </Layout>
  );
};
