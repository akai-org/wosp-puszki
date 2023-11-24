import { DepositBoxForm } from "@/components";
import { Modal } from "@/components/Modal/Modal"
import { AMOUNTS_KEYS, BoxData, DepositContext, useDepositContextValues, useGetBoxQuery } from "@/utils";
import { useParams } from "react-router-dom"

export const EditBoxPage = () => {

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
  const depositValues = useDepositContextValues(data);

  return (
    <Modal title={'Modyfikuj zawartość puszki'}>
      <DepositContext.Provider value={depositValues}>
        <DepositBoxForm editMode boxId={id} />
      </DepositContext.Provider>
    </Modal>
  )
}