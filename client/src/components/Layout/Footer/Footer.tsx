import { COUNTED_BY_ROUTE, CountedBy, MAIN_ROUTE } from '@/utils';
import Title from 'antd/lib/typography/Title';
import { Link } from 'react-router-dom';
import { EditOutlined } from '@ant-design/icons';
import _ from 'lodash';

interface Props {
  countedBy: CountedBy | null;
}

export const Footer = ({ countedBy }: Props) => {
  return (
    <Title level={5}>
      {_.isEmpty(countedBy)
        ? 'Ustaw dane osób liczących '
        : `Osoby liczące:
      ${countedBy?.first_counted_by_name}, ${countedBy?.second_counted_by_name}`}
      <Link to={`/${MAIN_ROUTE}/${COUNTED_BY_ROUTE}`}>
        <EditOutlined />
      </Link>
    </Title>
  );
};
