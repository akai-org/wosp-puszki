import { DepositBoxForm } from "@/components";
import { Modal } from "@/components/Modal/Modal"
import { DepositContext, useDepositContextValues } from "@/utils";
import { useParams } from "react-router-dom"

export const EditBoxPage = () => {

  const { id } = useParams();
  const contextData = useDepositContextValues();

  return (
    <Modal title={'Modyfikuj zawartość puszki'}>
      <DepositContext.Provider value={contextData}>
        <DepositBoxForm />
      </DepositContext.Provider>
    </Modal>
  )
}