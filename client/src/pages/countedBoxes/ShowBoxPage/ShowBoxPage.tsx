import { ContentColumns } from "@/components";
import { Modal } from "@/components/Modal/Modal";
import { BoxData, useGetBoxQuery, AMOUNTS_KEYS } from "@/utils";
import { useParams } from "react-router-dom";

export const ShowBoxPage = () => {

  const { id } = useParams();
  const queryData = useGetBoxQuery(id!).data!;

  let amounts: any = {};

  if (queryData) {
    Array.from(AMOUNTS_KEYS).forEach((key) => {
      amounts[key] = queryData[key]
    })
  }

  const data: BoxData = {
    amounts,
    comment: queryData?.comment
  }

  return (
    <Modal title={'Zawartość puszki'}>
      <ContentColumns boxData={data} total={queryData?.amount_PLN} />
    </Modal>
  )
}