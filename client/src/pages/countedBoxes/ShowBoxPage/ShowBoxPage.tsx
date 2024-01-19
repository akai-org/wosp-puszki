import { ContentColumns } from "@/components";
import { Modal } from "@/components/Modal/Modal";
import { BoxData, useGetBoxQuery, AMOUNTS_KEYS } from "@/utils";
import { Button, Space } from "antd";
import s from './ShowBoxPage.module.less'
import { Link, useParams } from "react-router-dom";

export const ShowBoxPage = () => {

  const { id } = useParams();

  const queryData = id ? useGetBoxQuery(id).data : undefined;

  let amounts: any = {};

  if (queryData) {
    Array.from(AMOUNTS_KEYS).forEach((key) => {
      amounts[key] = queryData[key]
    })
  }

  const data: BoxData = {
    amounts,
    comment: queryData?.comment || ""
  }

  return (
    <Modal title={'Zawartość puszki'}>
      <Space direction="vertical">
        <ContentColumns boxData={data} total={queryData?.amount_PLN || 0} />
        <Space>
          {!queryData?.is_confirmed && (
            <Link to={`/liczymy/countedBoxes${queryData?.is_confirmed ? '/approved' : ''}/edit/${id}`}>
              <Button type="primary" className={s.editButton}>
                Edytuj puszke
              </Button>
            </Link>
          )}
          {queryData?.is_confirmed ? (
            <Button type="primary" className={s.editButton}>
              Confij zatwierdzenie
            </Button>
          ) : (
            <Button type="primary" className={s.editButton}>
              Zatwierdź
            </Button>
          )}
        </Space>
      </Space>
    </Modal>
  )
}