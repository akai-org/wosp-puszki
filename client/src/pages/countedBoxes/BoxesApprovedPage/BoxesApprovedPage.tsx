import { CreateTable } from '@components/table/CreateTable';
import { Typography, Space, Layout } from 'antd';
import { useState, useEffect } from 'react';

import type { TableColumns, DataType } from '@/utils';

import s from './BoxesApprovedPage.module.css';

const { Title } = Typography;
const { Content } = Layout;

export const BoxesApprovedPage = () => {
  const [data] = useState<DataType[]>([
    {
      key: '1',
      name: 'C John Brown',
      age: 32,
      address: 'New York No. 1 Lake Park',
      date: '2021-01-01',
    },
    {
      key: '2',
      name: 'A Jim Green',
      age: 42,
      address: 'London No. 2 Lake Park',
      date: '2022-01-01',
    },
    {
      key: '3',
      name: 'B Jim Black',
      age: 32,
      address: 'Sidney No. 1 Lake Park',
      date: '2012-01-01',
    },
  ]);

  const columnsOptions: TableColumns[] = [
    {
      titleName: 'Name',
      keyName: 'name',
      sortType: 'string',
      search: true,
    },
    {
      titleName: 'Age',
      keyName: 'age',
      sortType: 'number',
      search: false,
    },
    {
      titleName: 'Address',
      keyName: 'address',
      sortType: 'string',
      search: true,
    },
    {
      titleName: 'Date',
      keyName: 'date',
      sortType: 'date',
      search: true,
    },
    {
      titleName: 'Actions',
      keyName: 'actions',
      actions: [
        {
          title: 'Edit',
          link: '/countedBoxes/boxesApproved/edit/',
        },
        {
          title: 'Delete',
          link: '/countedBoxes/boxesApproved/delete/',
        },
      ],
    },
  ];

  useEffect(() => {
    //fetching data here
  }, []);

  return (
    <Layout>
      <Content className={s.content}>
        <Space direction="vertical" size="small" className={s.space}>
          <Title level={2}>Zatwierdzone</Title>
          <CreateTable data={data} columnsOptions={columnsOptions} />
        </Space>
      </Content>
    </Layout>
  );
};
