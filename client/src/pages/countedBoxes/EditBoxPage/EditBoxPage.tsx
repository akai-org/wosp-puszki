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

  const data: BoxData | null = queryData ? {
    amounts,
    comment: queryData?.comment || ""
  } : null

  return (
    <Modal title='Modyfikuj zawartość puszki'>
      <div>{data && <EditBoxForm id={id} data={data} />}</div>
    </Modal>
  )
}

const EditBoxForm = ({ id, data }: { id?: string, data: BoxData | null }) => {
  const depositValues = useDepositContextValues(data);

  return (
    <DepositContext.Provider value={depositValues}>
      <DepositBoxForm editMode boxId={id} />
    </DepositContext.Provider>
  )
}
