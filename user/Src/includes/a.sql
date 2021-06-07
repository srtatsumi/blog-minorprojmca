USE [IIMS_SST_645819_19_20]
GO
/****** Object:  StoredProcedure [dbo].[RPT_GSTR_B2B]    Script Date: 12/29/2020 5:49:36 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

ALTER PROCEDURE [dbo].[RPT_GSTR_B2B] ( @S_DATE AS DATETIME, @E_DATE AS DATETIME, @REG nvarchar(40)=NULL ) 
AS 
Declare @S_QUERY AS NVARCHAR(MAX) 
BEGIN 
	SET NOCOUNT ON; 
	SET @S_QUERY='
			select
				(Select Top(1)COMP_NAME from COMPMAST) Comp_Name ,
				isnull(prty_gst,'''') GSTIN_NO, 
				ci_cmno Invoice_No,
				ci_cmdate Invoice_Date,
				sum(ci_net_amt) tot_ci_net_amt, 
				(select sum(ci.ci_net_amt) from cmitem ci where ci.ci_cmno=cmitem.ci_cmno) Invoice_Value, 
				(select top(1) GST_State_tin+''-''+RDS_STATE from COMPMAST) POS,
				''N'' Reverse_Charge, 
				''Regular'' Invoice_Type, 
				'''' E_Com_GSTIN, 
				ci_vat_per Rate ,
				sum((ci_bsic_amt-ci_sch_amt_pri-ci_sch_amt_sec-ci_spl_disc_amt-isnull(ci_sec_disc_amt,0))) taxble_amt , 
				0.00 Cess_Amt, 
				cm_prty_code, 
				prty_name 
			from 
			cmitem inner join prodmast on prod_code=ci_prodcd inner join cmfile on cm_cmno=ci_cmno inner join 
			prtymast on prty_code=Cm_Prty_Code 
			where 
			ci_cmdate between 
			('''+cast(cast(@S_DATE as datetime)as nvarchar(50))+''') 
			and 
			('''+cast(cast(@E_DATE as datetime) as nvarchar(50))+''')'

		IF @REG='REGISTERED' 
			SET @S_QUERY=@S_QUERY +' AND (len(isnull(prtymast.prty_GST,''''))>10)' 

		IF @REG='UNREGISTERED' 
			SET @S_QUERY=@S_QUERY +' AND (len(isnull(prtymast.prty_GST,''''))<=10)' 
		
		set @S_QUERY=@S_QUERY + ' group by prty_gst,ci_cmno,ci_cmdate, ci_vat_per ,cm_prty_code, prty_name order by ci_cmdate, ci_cmno ' 

	PRINT (@S_QUERY) 
	exec(@S_QUERY) 
END